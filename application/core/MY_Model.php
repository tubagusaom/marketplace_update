<?php
/**
 * A base model with a series of CRUD functions (powered by CI's query builder),
 * validation-in-model support, event callbacks and more.
 *
 * @link http://github.com/jamierumbelow/codeigniter-base-model
 * @copyright Copyright (c) 2012, Jamie Rumbelow <http://jamierumbelow.net>
 */

class MY_Model extends CI_Model
{

    /* --------------------------------------------------------------
     * VARIABLES
     * ------------------------------------------------------------ */

    /**
     * This model's default database table. Automatically
     * guessed by pluralising the modelFf name.
     */
    protected $_kode_lsp = 'tbl007_';
    protected $_table;

    /**alamat_ip_terakhir
     * The database connection object. Will be set to the default
     * connection. This allows individual models to use different DBs
     * without overwriting CI's global $this->db connection.
     */
    public $_database;

    /**
     * This model's default primary key or unique identifier.
     * Used by the get(), update() and delete() functions.
     */
    protected $primary_key = 'id';

    /**
     * Support for soft deletes and this model's 'deleted' key
     */
    protected $soft_delete = FALSE;
    protected $soft_delete_key = 'deleted';
    protected $_temporary_with_deleted = FALSE;
    protected $_temporary_only_deleted = FALSE;

    /**
     * The various callbacks available to the model. Each are
     * simple lists of method names (methods will be run on $this).
     */
	protected $table_label;
	protected $before_create = array('add_callback', 'update_callback');
	protected $before_update = array('update_callback');
    protected $after_create = array();
    //protected $before_update = array();
    protected $after_update = array();
    protected $before_get = array();
    protected $after_get = array();
    protected $before_delete = array();
    protected $after_delete = array();
    protected $callback_parameters = array();
    protected $protected_attributes = array();
	protected $belongs_to = array();
    protected $has_many = array();
    protected $_with = array();
    protected $validate = array();
    protected $skip_validation = FALSE;
    protected $return_type = 'object';
    protected $_temporary_return_type = NULL;
	protected $_unique = array();
	protected $validation_result;
	protected $_order;
	protected $_order_criteria = 'ASC';
	protected $_order_escape = TRUE;
	protected $_db_config = 'default';
	protected $_columns = array();
	protected $_return =  'default';
	protected $_select = array();
	protected $_formatter = array();
	protected $_where = array();
	protected $_fk_check = '';
	protected $_post;
	protected $_validation_array = array();
	protected $_abandoned_columns = array();

    /* --------------------------------------------------------------
     * GENERIC METHODS
     * ------------------------------------------------------------ */

    /**
     * Initialise the model, tie into the CodeIgniter superobject and
     * try our best to guess the table name.
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('inflector');

        $this->_fetch_table();

		if($this->_db_config != 'default')
		{
			$this->db = $this->load->database($this->_db_config, TRUE);
		}

        $this->_database = $this->db;

        array_unshift($this->before_create, 'protect_attributes');
        array_unshift($this->before_update, 'protect_attributes');

        $this->_temporary_return_type = $this->return_type;
    }

	public function add_callback($data)
	{
		$data['created_by'] = $this->auth->get_user_id();
		$data['created_when'] = date('Y-m-d h:i:s');
		return $data;
	}

	public function update_callback($data)
	{
		$data['updated_by'] = $this->auth->get_user_id();
		$data['updated_when'] = date('Y-m-d h:i:s');
		return $data;
	}

	/* --------------------------------------------------------------
     * UNIQUE CHECK
     * ------------------------------------------------------------ */

	public function check_unique($data, $id = false)
	{
		$_validation = array();

		if(isset($this->_unique) && count($this->_unique) > 0)
		{
			$uniques = $this->_unique['unique'];

			if(!$this->_unique['group'])
			{
				$_validate = true;

				foreach($uniques as $unique)
				{
					if(array_key_exists($unique, $data))
					{
						$_result = $this->get_single($this->get_by(array($unique=>$data[$unique])));
						if($_result)
						{
							if($id)
							{
								if($id != $_result->{$this->primary_key})
								{
									$_validate = false;
									$this->_validation_array[] = $this->_columns[$unique]['label'] . ' sudah ada';
								}
							}
							else
							{
								$_validate = false;
								$this->_validation_array[] = $this->_columns[$unique]['label'] . ' sudah ada';
							}

						}
					}
				}
				return $_validate;
			}
			else
			{
				$where = array();
				$_field = "";
				foreach($uniques as $unique)
				{
					if(array_key_exists($unique, $data))
					{
						$_where[$unique] = $data[$unique];
						$_field .= $_field == "" ? $this->_columns[$unique]['label'] : " dan " .$this->_columns[$unique]['label'];
					}
				}

				$_field .= ' sudah ada';
				if($id)
				{
					$_where['id !='] = $id;
					$this->_database->where($_where);
					$this->_database->from($this->_table);
					if($this->_database->count_all_results() > 1)
					{
						$_validation[] = $_field;
						$_validate = false;
					}
				}
				else
				{
					$this->_database->where($_where);
					$this->_database->from($this->_table);
					if($this->_database->count_all_results() >= 1)
					{
						$_validation[] = $_field;
						$_validate = false;
					}
				}

				if(count($_validation) >= 1)
				{
					$this->_validation_array = array_merge($_validation, $this->_validation_array);
					return false;
				}
				else return true;

			}
		}
		else
		{
			return true;
		}
	}

	public function get_validation()
	{
		return $this->_validation_array;
	}

    /* --------------------------------------------------------------
     * CRUD INTERFACE
     * ------------------------------------------------------------ */

	function get_single($rows)
	{
		$result = false;

		if(is_array($rows) && count($rows) == 1)
		{
			foreach($rows as $row)
			{
				$result = $row;
			}
		}
		elseif(is_object($rows))
		{
			$result = $rows;
		}

		return $result;
	}

    /**
     * Fetch a single record based on the primary key. Returns an object.
     */
    public function get($primary_value)
    {
		return $this->get_by($this->primary_key, $primary_value);
    }

	public function get_first(){
		$rows = false;

		$where = func_get_args();

		$this->_set_where($where);

		$row = $this->_database->get($this->_table)
                        ->{$this->_return_type()}();

        $this->_temporary_return_type = $this->return_type;

		$this->_with = array();

		if(is_array($row))
		{
			$rows = $row[0];
		}

		return $rows;
	}

	public function set_db_params()
	{
		$param = func_get_args();

		if(func_num_args() % 2 == 0)
		{
			for($i = 0; $i < func_num_args(); $i++)
			{
				if($i % 2 == 0)
				{
					call_user_func(array($this->_database, $param[$i]), $param[$i + 1]);
				}
			}
		}
	}

    /**
     * Fetch a single record based on an arbitrary WHERE call. Can be
     * any valid value to $this->_database->where().
     */
    public function get_by()
    {
        $where = func_get_args();

        if ($this->soft_delete && $this->_temporary_with_deleted !== TRUE)
        {
            $this->_database->where($this->soft_delete_key, (bool)$this->_temporary_only_deleted);
        }

		$this->_set_where($where);

        $this->trigger('before_get');

        $row = $this->_database->get($this->_table)
                        ->{$this->_return_type()}();
        $this->_temporary_return_type = $this->return_type;

        $row = $this->trigger('after_get', $row);

        $this->_with = array();
        return $row;
    }

    /**
     * Fetch an array of records based on an array of primary values.
     */
    public function get_many($values)
    {
        $this->_database->where_in($this->primary_key, $values);

        return $this->get_all();
    }

    /**
     * Fetch an array of records based on an arbitrary WHERE call.
     */
    public function get_many_by()
    {
        $where = func_get_args();

        $this->_set_where($where);

        return $this->get_all();
    }

    /**
     * Fetch all the records in the table. Can be used as a generic call
     * to $this->_database->get() with scoped methods.
     */
    public function get_all()
    {
        $this->trigger('before_get');

        if ($this->soft_delete && $this->_temporary_with_deleted !== TRUE)
        {
            $this->_database->where($this->soft_delete_key, (bool)$this->_temporary_only_deleted);
        }

        $result = $this->_database->get($this->_table)
                           ->{$this->_return_type(1)}();
        $this->_temporary_return_type = $this->return_type;

        foreach ($result as $key => &$row)
        {
            $row = $this->trigger('after_get', $row, ($key == count($result) - 1));
        }

        $this->_with = array();
        return $result;
    }

    /**
     * Insert a new row into the table. $data should be an associative array
     * of data to be inserted. Returns newly created ID.
     */
    public function insert($data, $skip_validation = FALSE)
    {
        if ($skip_validation === FALSE)
        {
            $data = $this->validate($data);
        }

        if ($data !== FALSE)
        {

            $data = $this->trigger('before_create', $data);

            $this->_database->insert($this->_table, $data);

            $insert_id = $this->_database->insert_id();

            $this->trigger('after_create', $insert_id);

            return $insert_id;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Insert multiple rows into the table. Returns an array of multiple IDs.
     */
    public function insert_many($data, $skip_validation = FALSE)
    {
        $ids = array();

        foreach ($data as $key => $row)
        {
            $ids[] = $this->insert($row, $skip_validation, ($key == count($data) - 1));
        }

        return $ids;
    }

    /**
     * Updated a record based on the primary value.
     */
    public function update($primary_value, $data, $skip_validation = FALSE)
    {
        $data = $this->trigger('before_update', $data);

        if ($skip_validation === FALSE)
        {
            $data = $this->validate($data);
        }

        if ($data !== FALSE)
        {
            $result = $this->_database->where($this->primary_key, $primary_value)
                               ->set($data)
                               ->update($this->_table);

            $this->trigger('after_update', array($data, $result));

            return $result;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Update many records, based on an array of primary values.
     */
    public function update_many($primary_values, $data, $skip_validation = FALSE)
    {
        $data = $this->trigger('before_update', $data);

        if ($skip_validation === FALSE)
        {
            $data = $this->validate($data);
        }

        if ($data !== FALSE)
        {
            $result = $this->_database->where_in($this->primary_key, $primary_values)
                               ->set($data)
                               ->update($this->_table);

            $this->trigger('after_update', array($data, $result));

            return $result;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Updated a record based on an arbitrary WHERE clause.
     */
    public function update_by()
    {
        $args = func_get_args();
        $data = array_pop($args);

        $data = $this->trigger('before_update', $data);

        if ($this->validate($data) !== FALSE)
        {
            $this->_set_where($args);
            $result = $this->_database->set($data)
                               ->update($this->_table);
            $this->trigger('after_update', array($data, $result));

            return $result;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Update all records
     */
    public function update_all($data)
    {
        $data = $this->trigger('before_update', $data);
        $result = $this->_database->set($data)
                           ->update($this->_table);
        $this->trigger('after_update', array($data, $result));

        return $result;
    }

    /**
     * Delete a row from the table by the primary value
     */
    public function delete($id)
    {
        $this->trigger('before_delete', $id);

        $this->_database->where($this->primary_key, $id);

        if ($this->soft_delete)
        {
            $result = $this->_database->update($this->_table, array( $this->soft_delete_key => TRUE ));
        }
        else
        {
            $result = $this->_database->delete($this->_table);
        }

        $this->trigger('after_delete', $result);

        return $result;
    }

    /**
     * Delete a row from the database table by an arbitrary WHERE clause
     */
    public function delete_by()
    {
        $where = func_get_args();

	    $where = $this->trigger('before_delete', $where);

        $this->_set_where($where);


        if ($this->soft_delete)
        {
            $result = $this->_database->update($this->_table, array( $this->soft_delete_key => TRUE ));
        }
        else
        {
            $result = $this->_database->delete($this->_table);
        }

        $this->trigger('after_delete', $result);

        return $result;
    }

    /**
     * Delete many rows from the database table by multiple primary values
     */
    public function delete_many($primary_values)
    {
        $primary_values = $this->trigger('before_delete', $primary_values);

        $this->_database->where_in($this->primary_key, $primary_values);

        if ($this->soft_delete)
        {
            $result = $this->_database->update($this->_table, array( $this->soft_delete_key => TRUE ));
        }
        else
        {
            $result = $this->_database->delete($this->_table);
        }

        $this->trigger('after_delete', $result);

        return $result;
    }


    /**
     * Truncates the table
     */
    public function truncate()
    {
        $result = $this->_database->truncate($this->_table);

        return $result;
    }



    /* --------------------------------------------------------------
     * RELATIONSHIPS
     * ------------------------------------------------------------ */

    public function with($relationship)
    {
        $rows = $this->relate($relationship);

		if($this->_return == 'json')
		{
			$data = $this->data_formatter($rows);
			$rows = $data;
		}

		$this->_return = 'default';
		$this->_select = array();
		$this->_formatter = array();
		$this->_where = array();

		return $rows;
    }

    public function relate($relationship)
    {
		$this->_with = is_array($relationship) ? $relationship :(array) $relationship;

		$this->_select[] = $this->_table . "." . $this->primary_key;
		$this->_formatter[] = 'int';

		foreach(array_keys($this->_columns) as $_column)
		{
			$this->_select[] = $this->_table . "." . $_column;
		}
		foreach($this->_columns as $col)
		{
			$this->_formatter[] = $col['formatter'];
		}

		$belongs_to = $this->belongs_to;
		$has_many = $this->has_many;

		$this->_database->from($this->_table);

		foreach($this->_with as $relate)
		{
			if(array_key_exists($relate, $belongs_to))
			{

				$this->load->model($belongs_to[$relate]['model'], $relate . '_model', TRUE);

				if(array_key_exists('join_type',$belongs_to[$relate]))
				{
					$this->_database->join($this->{$relate . '_model'}->_table,
					$this->_table . '.' . $belongs_to[$relate]['primary_key'] . '=' .
					$this->{$relate . '_model'}->_table . '.' .
					$this->{$relate . '_model'}->primary_key, $belongs_to[$relate]['join_type']);
				}
				else
				{
					$this->_database->join($this->{$relate . '_model'}->_table,
					$this->_table . '.' . $belongs_to[$relate]['primary_key'] . '=' .
					$this->{$relate . '_model'}->_table . '.' .
					$this->{$relate . '_model'}->primary_key);
				}

				$this->_select = array_merge($this->_select, $belongs_to[$relate]['retrieve_columns']);

				foreach($this->{$relate . '_model'}->_columns as $col)
				{
					$this->_formatter[] = $col['formatter'];
				}
			}
			elseif(array_key_exists($relate, $has_many))
			{
				$this->load->model($has_many[$relate]['model'], $relate . '_model', TRUE);

				$this->_database->join($this->{$relate . '_model'}->_table,
					$this->_table . '.' . $this->primary_key . '=' .
					$this->{$relate . '_model'}->_table . '.' . $has_many[$relate]['primary_key']);

				$this->_select = array_merge($this->_select, $has_many[$relate]['retrieve_columns']);

				foreach($this->{$relate . '_model'}->_columns as $col)
				{
					$this->_formatter[] = $col['formatter'];
				}
			}
		}

		$this->_database->select($this->_select);

		if(isset($this->_order))
		{
			$this->order_by($this->_order);
		}

		if(isset($this->_where))
		{
			$this->_database->where($this->_where);
		}

		$rows = $this->_database->get()->{$this->_return_type(1)}();

		$this->_temporary_return_type = $this->return_type;

		$this->_with = array();
		$this->_where = array();

		return $rows;
    }

	/* --------------------------------------------------------------
     * DATA FORMATTER
     * ------------------------------------------------------------ */

    /**
     * Return value with formatter
     */

	public function data_formatter($data = false) {

        $row = array();
        $rows = array();

        if ($data) {
            foreach ($data as $record) {
                for ($i = 0; $i < count($this->_select); $i++) {
                    if ($this->_formatter[$i] == 'int') {
                        $row[$this->_select[$i]] = intval($record->{$this->_select[$i]});
                    } elseif ($this->_formatter[$i] == 'decimal') {
                        $row[$this->_select[$i]] = number_format($record->{$this->_select[$i]}, 2, ",", ".");
                    } elseif ($this->_formatter[$i] == 'rupiah') {
                        $rupiah = "";
                        $uang = $record->{$this->_select[$i]};
                        $panjang = Strlen($uang);

                        while ($panjang > 3) {
                            $rupiah = "." . substr($uang, -3) . $rupiah;
                            $lebar = strlen($uang) - 3;
                            $uang = substr($uang, 0, $lebar);
                            $panjang = strlen($uang);
                        }

                        $rupiah = "Rp " . $uang . $rupiah;
                        //return $rupiah;

                        $row[$this->_select[$i]] = $rupiah;
                    } elseif ($this->_formatter[$i] == 'datetime') {
                        $row[$this->_select[$i]] = is_null($record->{$this->_select[$i]}) ? '' : date('d/m/Y H:i:s', strtotime($record->{$this->_select[$i]}));
                    } elseif ($this->_formatter[$i] == 'date') {
                        $row[$this->_select[$i]] = is_null($record->{$this->_select[$i]}) ? '' : date('d/m/Y', strtotime($record->{$this->_select[$i]}));
                    } elseif ($this->_formatter[$i] == 'time') {
                        $row[$this->_select[$i]] = is_null($record->{$this->_select[$i]}) ? '' : date('H:i:s', strtotime($record->{$this->_select[$i]}));
                    } elseif ($this->_formatter[$i] == 'upper') {
                        $row[$this->_select[$i]] = strtoupper($record->{$this->_select[$i]});
                    } elseif ($this->_formatter[$i] == 'lower') {
                        $row[$this->_select[$i]] = strtolower($record->{$this->_select[$i]});
                    } elseif ($this->_formatter[$i] == 'first') {
                        $row[$this->_select[$i]] = ucwords(strtolower($record->{$this->_select[$i]}));
                    } elseif ($this->_formatter[$i] == 'general_date') {

                        $tanggal = $record->{$this->_select[$i]};

                        if($tanggal =="" || $tanggal == '0000-00-00' || $tanggal == '0'){
                            $row[$this->_select[$i]] = '-';
                        }else{
                            $row[$this->_select[$i]] = get_general_date($record->{$this->_select[$i]});
                        }
                    } elseif ($this->_formatter[$i] == 'long_date') {
                        $row[$this->_select[$i]] = get_long_date($record->{$this->_select[$i]});
                    } elseif ($this->_formatter[$i] == 'long_date_time') {
                        $row[$this->_select[$i]] = get_long_datetime($record->{$this->_select[$i]});
                    } elseif (is_array($this->_formatter[$i])) {
                        $choice = $this->_formatter[$i];
                        $row[$this->_select[$i]] = $choice[$record->{$this->_select[$i]}];
                    } elseif (method_exists($this, $this->_formatter[$i])) {
                        $row[$this->_select[$i]] = call_user_func_array(
                                array($this, $this->_formatter[$i]), array($record->{$this->_select[$i]})
                        );
                    } elseif (strpos($this->_formatter[$i], 'fn_') !== false) {
                        $format = $this->_formatter[$i];
                        $pos = strpos($format, '(');
                        $func = str_replace('fn_', '', substr($format, 0, $pos));
                        $param = array($record->{$this->_select[$i]});
                        $params = explode(',', str_replace(array('(', ')'), '', substr($format, $pos, strlen($format))));
                        $row[$this->_select[$i]] = call_user_func_array($func, array_merge($param, $params));
                    } elseif ($this->_formatter[$i] == 'string') {
                        $row[$this->_select[$i]] = $record->{$this->_select[$i]};
                    } elseif (property_exists($record, $this->_formatter[$i])) {
                        $row[$this->_select[$i]] = $record->{$this->_formatter[$i]};
                    } else {
                        $row[$this->_select[$i]] = '';
                    }
                }
                $rows[] = $row;
            }
        }

        return $rows;
    }

    /* --------------------------------------------------------------
     * UTILITY METHODS
     * ------------------------------------------------------------ */

    /**
     * Retrieve and generate a form_dropdown friendly array
     */
    function dropdown()
    {
        $args = func_get_args();
		if(count($args) == 3)
		{
			list($key, $value, $_empty) = $args;
		}
        elseif(count($args) == 2)
        {
            list($key, $value) = $args;
        }
        else
        {
            $key = $this->primary_key;
            $value = $args[0];
        }

		if(isset($this->_where))
		{
			$this->_database->where($this->_where);
		}

        $this->trigger('before_dropdown', array( $key, $value ));

        if ($this->soft_delete && $this->_temporary_with_deleted !== TRUE)
        {
            $this->_database->where($this->soft_delete_key, FALSE);
        }

        $result = $this->_database->select(array($key, $value))
                           ->get($this->_table)
                           ->result();

        $options = array();

		if(isset($_empty))
		{
			$options[$_empty['val']] = $_empty['text'];
		}

        foreach ($result as $row)
        {
            $options[$row->{$key}] = $row->{$value};
        }

        $options = $this->trigger('after_dropdown', $options);

        return $options;
    }

	function count_with($relationship)
	{
		$this->_with = is_array($relationship) ? $relationship :(array) $relationship;

		$this->_select[] = $this->_table . "." . $this->primary_key;

		foreach(array_keys($this->_columns) as $_column)
		{
			$this->_select[] = $this->_table . "." . $_column;
		}

		$belongs_to = $this->belongs_to;
		$has_many = $this->has_many;

		$this->_database->from($this->_table);

		foreach($this->_with as $relate)
		{
			if(array_key_exists($relate, $belongs_to))
			{

				$this->load->model($belongs_to[$relate]['model'], $relate . '_model', TRUE);

				if(array_key_exists('join_type',$belongs_to[$relate]))
				{
					$this->_database->join($this->{$relate . '_model'}->_table,
					$this->_table . '.' . $belongs_to[$relate]['primary_key'] . '=' .
					$this->{$relate . '_model'}->_table . '.' .
					$this->{$relate . '_model'}->primary_key, $belongs_to[$relate]['join_type']);
				}
				else
				{
					$this->_database->join($this->{$relate . '_model'}->_table,
					$this->_table . '.' . $belongs_to[$relate]['primary_key'] . '=' .
					$this->{$relate . '_model'}->_table . '.' .
					$this->{$relate . '_model'}->primary_key);
				}

				$this->_select = array_merge($this->_select, $belongs_to[$relate]['retrieve_columns']);
			}
			elseif(array_key_exists($relate, $has_many))
			{
				$this->load->model($has_many[$relate]['model'], $relate . '_model', TRUE);

				$this->_database->join($this->{$relate . '_model'}->_table,
					$this->_table . '.' . $this->primary_key . '=' .
					$this->{$relate . '_model'}->_table . '.' . $has_many[$relate]['primary_key']);

				$this->_select = array_merge($this->_select, $has_many[$relate]['retrieve_columns']);
			}
		}

		$this->_database->select($this->_select);

		if(isset($this->_order))
		{
			$this->order_by($this->_order);
		}

		if(isset($this->_where))
		{
			$this->_database->where($this->_where);
		}
		$total = $this->_database->count_all_results();
		$this->_select = array();
		$this->_with = array();
		$this->_where = array();
		return $total;
	}

    /**
     * Fetch a count of rows based on an arbitrary WHERE call.
     */
    public function count_by()
    {
        if ($this->soft_delete && $this->_temporary_with_deleted !== TRUE)
        {
            $this->_database->where($this->soft_delete_key, (bool)$this->_temporary_only_deleted);
        }

        $where = func_get_args();
        $this->_set_where($where);

        return $this->_database->count_all_results($this->_table);
    }

    /**
     * Fetch a total count of rows, disregarding any previous conditions
     */
    public function count_all()
    {
        if ($this->soft_delete && $this->_temporary_with_deleted !== TRUE)
        {
            $this->_database->where($this->soft_delete_key, (bool)$this->_temporary_only_deleted);
        }

        return $this->_database->count_all($this->_table);
    }

    /**
     * Tell the class to skip the insert validation
     */
    public function skip_validation()
    {
        $this->skip_validation = TRUE;
        return $this;
    }

    /**
     * Get the skip validation status
     */
    public function get_skip_validation()
    {
        return $this->skip_validation;
    }

    /**
     * Return the next auto increment of the table. Only tested on MySQL.
     */
    public function get_next_id()
    {
        return (int) $this->_database->select('AUTO_INCREMENT')
            ->from('information_schema.TABLES')
            ->where('TABLE_NAME', $this->_table)
            ->where('TABLE_SCHEMA', $this->_database->database)->get()->row()->AUTO_INCREMENT;
    }

    /**
     * Getter for the table name
     */
    public function table()
    {
        return $this->_table;
    }

    /* --------------------------------------------------------------
     * GLOBAL SCOPES
     * ------------------------------------------------------------ */

    /**
     * Return the next call as an array rather than an object
     */
    public function as_array()
    {
        $this->_temporary_return_type = 'array';
        return $this;
    }

    /**
     * Return the next call as an object rather than an array
     */
    public function as_object()
    {
        $this->_temporary_return_type = 'object';
        return $this;
    }

    /**
     * Don't care about soft deleted rows on the next call
     */
    public function with_deleted()
    {
        $this->_temporary_with_deleted = TRUE;
        return $this;
    }

    /**
     * Only get deleted rows on the next call
     */
    public function only_deleted()
    {
        $this->_temporary_only_deleted = TRUE;
        return $this;
    }

    /* --------------------------------------------------------------
     * OBSERVERS
     * ------------------------------------------------------------ */

    /**
     * MySQL DATETIME created_at and updated_at
     */
    public function created_at($row)
    {
        if (is_object($row))
        {
            $row->created_by = date('Y-m-d H:i:s');
        }
        else
        {
            $row['created_by'] = date('Y-m-d H:i:s');
        }

        return $row;
    }

    public function updated_at($row)
    {
        if (is_object($row))
        {
            $row->updated_at = date('Y-m-d H:i:s');
        }
        else
        {
            $row['updated_at'] = date('Y-m-d H:i:s');
        }

        return $row;
    }

    /**
     * Serialises data for you automatically, allowing you to pass
     * through objects and let it handle the serialisation in the background
     */
    public function serialize($row)
    {
        foreach ($this->callback_parameters as $column)
        {
            $row[$column] = serialize($row[$column]);
        }

        return $row;
    }

    public function unserialize($row)
    {
        foreach ($this->callback_parameters as $column)
        {
            if (is_array($row))
            {
                $row[$column] = unserialize($row[$column]);
            }
            else
            {
                $row->$column = unserialize($row->$column);
            }
        }

        return $row;
    }

    /**
     * Protect attributes by removing them from $row array
     */
    public function protect_attributes($row)
    {
        foreach ($this->protected_attributes as $attr)
        {
            if (is_object($row))
            {
                unset($row->$attr);
            }
            else
            {
                unset($row[$attr]);
            }
        }

        return $row;
    }

    /* --------------------------------------------------------------
     * QUERY BUILDER DIRECT ACCESS METHODS
     * ------------------------------------------------------------ */

    /**
     * A wrapper to $this->_database->order_by()
     */
    public function order_by($criteria, $order = 'ASC', $order_escape = TRUE)
    {
		if(!$order_escape)
		{
			$this->_database->_protect_identifiers = FALSE;
		}
        if ( is_array($criteria) )
        {
            foreach ($criteria as $key => $value)
            {
                $this->_database->order_by($key, $value);
            }
        }
        else
        {
            $this->_database->order_by($criteria, $order);
        }
		if(!$order_escape)
		{
			$this->_database->_protect_identifiers = TRUE;
		}
        return $this;
    }

    /**
     * A wrapper to $this->_database->limit()
     */
    public function limit($limit, $offset = 0)
    {
        $this->_database->limit($limit, $offset);
        return $this;
    }

    /* --------------------------------------------------------------
     * INTERNAL METHODS
     * ------------------------------------------------------------ */

    /**
     * Trigger an event and call its observers. Pass through the event name
     * (which looks for an instance variable $this->event_name), an array of
     * parameters to pass through and an optional 'last in interation' boolean
     */
    public function trigger($event, $data = FALSE, $last = TRUE)
    {
        if (isset($this->$event) && is_array($this->$event))
        {
            foreach ($this->$event as $method)
            {
                if (strpos($method, '('))
                {
                    preg_match('/([a-zA-Z0-9\_\-]+)(\(([a-zA-Z0-9\_\-\., ]+)\))?/', $method, $matches);

                    $method = $matches[1];
                    $this->callback_parameters = explode(',', $matches[3]);
                }

                $data = call_user_func_array(array($this, $method), array($data, $last));
            }
        }

        return $data;
    }

	/**
     * Return formatter single data
     */

	public function key_cast_format($key){

		$column = $this->_columns[$key];

		$result = "";

		if(empty($this->input->post($key)) && array_key_exists('nullable', $column))
		{
			$result = NULL;
		}
		else
		{
			switch($column['save_formatter'])
			{
				case 'int':
					$result = intval($this->input->post($key));
					break;
				case 'decimal':
					$result = number_format($this->input->post($key), 2, ".", ",");
					break;
				case 'datetime':
					$result = date('Y-m-d H:i:s', strtotime($this->input->post($key)));
					break;
				case 'date':
					if(strpos($this->input->post($key), "/") !== false)
					{
						$dates = array_reverse(explode("/", $this->input->post($key)));
						$result = implode('-', $dates);
					}
					else
					{
						$result = date('Y-m-d', strtotime($this->input->post($key)));
					}
					break;
				case 'time':
					$result = date('H:i:s', strtotime($this->input->post($key)));
					break;
				case 'upper':
					$result = strtoupper($this->input->post($key));
					break;
				case 'lower':
					$result = strtolower($this->input->post($key));
					break;
				case 'first':
					$result = ucwords(strtolower($this->input->post($key)));
					break;
				case 'first':
					$result = ucwords(strtolower($this->input->post($key)));
					break;
				case 'string':
					$result = $this->input->post($key);
					break;
                case 'text':
                    $result = $_POST[$key];
                    break;
				default:
					if(is_array($column['save_formatter']))
					{
						$choice = $column['save_formatter'];
						$result = $choice[$this->input->post($key)];
					}
					elseif(method_exists($this, $column['save_formatter']))
					{
						$result = call_user_func_array(
							array($this, $column['save_formatter']),
							array($this->input->post($key))
						);
					}
					elseif(strpos($column['save_formatter'], 'fn_') !== false)
					{
						$format = $column['save_formatter'];
						$pos = strpos($format, '(');
						$func = str_replace('fn_', '', substr($format, 0, $pos));
						$param = array($this->input->post($key));
						$params = explode(',', str_replace(array('(', ')'), '', substr($format, $pos, strlen($format))));
						$result =  call_user_func_array($func, array_merge($param, $params));
					}
					break;
			}
		}

		return $result;
	}

	/**
	* Auto populate form input data
	**/

	function auto_populate()
	{
		$result = array();
		$keys = array_keys($this->_columns);
		foreach($keys as $key)
		{
			if(!in_array($key, $this->_abandoned_columns))
			{
				$result[$key] = $this->key_cast_format($key);
			}
		}
		return $result;
	}

    /**
     * Run validation on the passed data
     */
    public function validate($data = false)
    {
		if(!$data)
		{
			$data = $this->auto_populate();
		}

        if($this->skip_validation)
        {
            return $data;
        }

        if(!empty($this->validate))
        {
            foreach($data as $key => $val)
            {
                $_POST[$key] = $val;
            }

            $this->load->library('form_validation');

            if(is_array($this->validate))
            {
                $this->form_validation->set_rules($this->validate);

                if ($this->form_validation->run() === TRUE)
                {
                    return $data;
                }
                else
                {
                    return FALSE;
                }
            }
            else
            {
                if ($this->form_validation->run($this->validate) === TRUE)
                {
                    return $data;
                }
                else
                {
                    return FALSE;
                }
            }
        }
        else
        {
            return $data;
        }
    }

    /**
     * Guess the table name by pluralising the model name
     */
    private function _fetch_table()
    {
        if ($this->_table == NULL)
        {
            $this->_table = plural(preg_replace('/(_m|_model)?$/', '', strtolower(get_class($this))));
        }
    }

    /**
     * Guess the primary key for current table
     */
    private function _fetch_primary_key()
    {
        if($this->primary_key == NULl)
        {
            $this->primary_key = $this->_database->query("SHOW KEYS FROM `".$this->_table."` WHERE Key_name = 'PRIMARY'")->row()->Column_name;
        }
    }

    /**
     * Set WHERE parameters, cleverly
     */
    protected function _set_where($params)
    {
        if (count($params) == 1 && is_array($params[0]))
        {
            foreach ($params[0] as $field => $filter)
            {
                if (is_array($filter))
                {
                    $this->_database->where_in($field, $filter);
                }
                else
                {
                    if (is_int($field))
                    {
                        $this->_database->where($filter);
                    }
                    else
                    {
                        $this->_database->where($field, $filter);
                    }
                }
            }
        }
        else if (count($params) == 1)
        {
            $this->_database->where($params[0]);
        }
    	else if(count($params) == 2)
		{
            if (is_array($params[1]))
            {
                $this->_database->where_in($params[0], $params[1]);
            }
            else
            {
                $this->_database->where($params[0], $params[1]);
            }
		}
		else if(count($params) == 3)
		{
			$this->_database->where($params[0], $params[1], $params[2]);
		}
        else
        {
            if (is_array($params[1]))
            {
                $this->_database->where_in($params[0], $params[1]);
            }
            else
            {
                $this->_database->where($params[0], $params[1]);
            }
        }
    }

    /**
     * Return the method name for the current return type
     */
    protected function _return_type($multi = FALSE)
    {
        $method = ($multi) ? 'result' : 'row';
        return $this->_temporary_return_type == 'array' ? $method . '_array' : $method;
    }

	function get_params($param, $erase = false)
	{
		if(property_exists(get_class($this), $param))
		{
			if($erase)
			{
				$result = $this->{$param};
				unset($this->{$param});
				return $result;
			}
			else
			{
				return $this->{$param};
			}
		}
		else
		{
			return false;
		}
	}

	function set_params($param)
	{

		$param_key = array_keys($param);

		foreach($param_key as $key)
		{
			if(property_exists(get_class($this), $key))
			{
				$this->{$key} = $param[$key];
			}
		}

		return $this;

	}

	public function distinct()
    {
        $this->_database->distinct();
        return $this;
    }

	public function get_columns($skip_primary_key = false)
	{
		if(!$skip_primary_key)
		{
			return array_merge(array('id'=>$this->primary_key), $this->_columns);
		}
		else
		{
			return $this->_columns;
		}
	}

	public function get_validate($validation, $paired = true)
	{

		$rule = array();
		$data = array();

		if($paired)
		{
			foreach($validation as $key=>$val)
			{
				$column = $this->_columns[$key];
				$rule[] = array(
					'field'   => $val,
					'label'   => $column['label'],
					'rules'   => $column['rule']
				);
				$_POST[$key] = $this->input->post($val);
				$data[$key] = $this->key_cast_format($key);
			}
		}
		else
		{
			foreach($validation as $key)
			{
				$column = $this->_columns[$key];
				$rule[] = array(
					'field'   => $key,
					'label'   => $column['label'],
					'rules'   => $column['rule']
				);
				$data[$key] = $this->key_cast_format($key);
			}
		}

		$this->load->library('form_validation');
		$this->form_validation->set_rules($rule);

		if ($this->form_validation->run() == FALSE)
		{
			return false;
		}
		else
		{
			return $data;
		}

	}

	public function set_validation()
	{
		foreach($this->_columns as $key=>$val)
		{
			if(!in_array($key, $this->_abandoned_columns))
			{
				$rule[] = array(
					'field'   => $key,
					'label'   => $val['label'],
					'rules'   => $val['rule']
				);
			}
		}
		$this->validate = $rule;
		return $this;
	}

	public function get_criteria($permission)
	{
		if(!is_array($permission))
		{
			return false;
		}
		$where = array();
		foreach($permission as $key=>$val)
		{
			if(isset($val->{$key}) && $val->{$key} == 1)
			{
				$criteria = $val->{$key . '_criteria'};
				if(!empty($criteria) && !is_null($criteria))
				{
					if(strpos($criteria, '.AND.') !== false)
					{
						$str_where_and = explode('.AND.', $criteria);
						foreach($str_where_and as $where_and)
						{
							$str_where = explode('.', $where_and);
							$where[$str_where[0]] = $this->operator_definition($str_where[1]) .
							$this->where_definition($str_where[2]);
						}
					}
					else
					{
						$str_where = explode('.', $criteria);
						$where[$str_where[0]] = $this->operator_definition($str_where[1]) .
							$this->where_definition($str_where[2]);
					}

				}

			}
		}
		return $where;
	}

	protected function operator_definition($ops)
	{
		if($ops == 'not')
		{
			return '<>';
		}
		elseif($ops == 'is')
		{
			return '';
		}
		elseif($ops == 'greater')
		{
			return '>';
		}
		elseif($ops == 'lower')
		{
			return '<';
		}
		elseif($ops == 'greater_equal')
		{
			return '>=';
		}
		elseif($ops == 'lower_equal')
		{
			return '<=';
		}
	}

	protected function where_definition($criteria)
	{
		if(strpos($criteria,'self') !== false)
		{
			$params = explode('::', $criteria);

			if($params[1] == 'user_id')
			{
				return $this->auth->get_user_id();
			}
			elseif($params[1] == 'role_id')
			{
				return $this->auth->get_role_id();
			}
			elseif($params[1] == 'unit_id')
			{
				$this->load->model('Pegawai_Model');
				$pegawai = $this->Pegawai_Model->get($this->auth->get_user_data('pegawai_id'));
				if($pegawai)
				{
					return $pegawai->unit_id;
				}
			}
			else
			{
				$this->auth->get_user_data($params[1]);
			}
		}
	}

	/*
		Set field column dari grid menggunakan nama field yang telah diseleksi
	*/

	public function fields_selected($selected)
	{
		$select = array($this->primary_key);
		$formatter = array('int');
		$columns = $this->_columns;
		if(!is_array($selected))
		{
			$fields = array($selected);
		}
		else
		{
			$fields = $selected;
		}
		foreach($fields as $field)
		{
			if(array_key_exists($field, $columns))
			{
				$select[] = $field;
				$formatter[] = $columns[$field]['formatter'];
			}
			else
			{
				$in_relation_status = false;
				if(isset($this->belongs_to)){
					foreach($this->belongs_to as $key_belong=>$val_belong){
						if(!$in_relation_status){
							if(!isset($this->{$key_belong})){
								$this->load->model($val_belong['model'], $key_belong);
							}
							if(array_key_exists($field, $this->{$key_belong}->_columns)){
								$select[] = $field;
								$formatter[] = $this->{$key_belong}->_columns[$field]['formatter'];
								$in_relation_status = true;
								break;
							}
						} else {
							break;
						}
					}
				}
				if(!$in_relation_status && isset($this->has_many)){
					foreach($this->has_many as $key_many=>$val_many){
						if(!$in_relation_status){
							if(!isset($this->{$key_many})){
								$this->load->model($val_many['model'], $key_many);
							}
							if(array_key_exists($field, $this->{$key_many}->_columns)){
								$select[] = $field;
								$formatter[] = $this->{$key_many}->_columns[$field]['formatter'];
								$in_relation_status = true;
								break;
							}
						} else {
							break;
						}
					}
				}
		    }
		}
		$this->_select = $select;
		$this->_formatter = $formatter;
		return $this;
	}

	public function get_selected()
	{

		$select = array($this->primary_key);
		$formatter = array('int');

		foreach($this->_columns as $key=>$val)
		{

			if(!array_key_exists('visible', $val))
			{
				if(array_key_exists('visible_when', $val))
				{
					$this->load->model('Role_Model');
					$roles = $this->Role_Model->get($this->auth->get_role_id());
					$visible = explode('.', $val['visible_when']);
					if($visible[0] == 'not')
					{
						if($roles->rolename != $visible[1])
						{
							$select[] = $key;
							$formatter[] = $val['formatter'];
						}
					}
					elseif($visible[0] == 'is')
					{
						if($roles->rolename == $visible[1])
						{
							$select[] = $key;
							$formatter[] = $val['formatter'];
						}
					}
				}
				else
				{
					$select[] = $key;
					$formatter[] = $val['formatter'];
				}
			}
		}
		$this->_select = $select;
		$this->_formatter = $formatter;
		return $this;
	}

	public function check_foreign_key()
	{
		$result = true;
		if(property_exists($this, 'belongs_to'))
		{
			foreach($this->belongs_to as $belongs)
			{
				$this->load->model($belongs['model']);
				$model = substr($belongs['model'], strpos($belongs['model'], '/') + 1, strlen($belongs['model']));
				$data = $this->{$model}->get($this->input->post($belongs['primary_key']));
				if(sizeof($data) == 0)
				{
					$this->_fk_check = $belongs['primary_key'] . ' tidak memiliki data referensi dengan kode ' . $this->input->post($belongs['primary_key']) . ' !';
					return false;
				}

			}
		}

		if(property_exists($this, '_enum'))
		{
			foreach($this->_enum as $key=>$val)
			{
				if(!in_array($this->input->post($key), $val))
				{
					$this->_fk_check = 'Kolom ' . strtolower($this->_columns[$key]['label']) . ' tidak sesuai pilihan !';
					return false;
				}
			}
		}

		return $result;
	}

	public function clear_tables($reset_autonumber = FALSE, $cascade = FALSE)
	{
		$process_status = TRUE;

		if(property_exists($this, 'has_many') && $cascade)
		{
			foreach($this->has_many as $child)
			{
				$this->load->model($child['model']);
				$model = substr($child['model'], strpos($child['model'], '/') + 1, strlen($child['model']));
				$clear_child = $this->{$model}->_database->query("DELETE FROM " . $this->{$model}->get_params('_table') . " WHERE " . $this->{$model}->primary_key. " IN (SELECT " . $this->primary_key . " FROM " . $this->_table . ")");
				if(!$clear_child)
				{
					$process_status = FALSE;
					break;
				}
			}
			if($process_status)
			{
				if(!$this->_database->query("DELETE FROM " . $this->_table))
				{
					$process_status = FALSE;
				}
			}
		}
		else
		{
			if(!$this->_database->query("DELETE FROM " . $this->_table))
			{
				$process_status = FALSE;
			}
		}
		if($reset_autonumber)
		{
			$this->_database->query("ALTER TABLE " . $this->_table . " AUTO_INCREMENT = 1");
		}
		return $process_status;
	}

	function delete_with_child($id)
	{

		$child_remove_status = TRUE;

		if(isset($this->has_many))
		{
			foreach($this->has_many as $child)
			{
				$model = $child['model'];
				$this->load->model($model);
				$child_remove_status = $this->{$model}->delete_by($child['primary_key'], $id);
			}
		}

		if($child_remove_status){
			return $this->delete($id);
		}
		else
		{
			return false;
		}

	}

	function max_by($column_name, $alias_name)
	{
		$this->db->select_max($column_name, $alias_name);
		$query = $this->db->get($this->_table);
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}

	function single_result($select)
	{
		$this->db->select($select);
		if(isset($this->_where))
		{
			$this->db->where($this->_where, false);
		}
		$query = $this->db->get($this->_table);
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}

	function groupped_by($group_by, $fields = array(), $with = array())
	{
		if(sizeof($fields) == 0)
		{
			return false;
		}

		$select = array();
		$this->formatter = array('int');

		foreach($fields as $field)
		{
			if(array_key_exists($field, $this->_columns))
			{
				$this->formatter[] = $this->_columns[$field]['formatter'];
			}
			else
			{
				$select[] = $field;
			}
		}
		$this->_database->select($fields);
		$this->_database->from($this->_table);

		if(sizeof($with) > 0)
		{
			foreach($with as $relation)
			{

				$this->join_table($relation, $this->belongs_to, $select);

				$this->join_table($relation, $this->has_many, $select);

			}
		}

		$this->_database->group_by($group_by);

		if(isset($this->_where))
		{
			$this->_database->where($this->_where);
		}

		if(isset($this->_order))
		{
			$this->order_by($this->_order);
		}

		$rows = $this->_database->get()->{$this->_return_type(1)}();

		$this->_temporary_return_type = $this->return_type;

		if($this->_return == 'json')
		{
			$data = $this->data_formatter($rows);
			$rows = $data;
		}

		$this->_return = 'default';
		$this->_select = array();
		$this->_formatter = array();
		$this->_where = array();

		return $rows;

	}

	function join_table($relation, $posessed, $select = array())
	{
		if(array_key_exists($relation, $posessed))
		{

			$this->load->model($posessed[$relation]['model'], $relation, TRUE);

			if(array_key_exists('join_type',$posessed[$relation]))
			{

				$this->_database->join($this->{$relation}->_table,
				$this->_table . '.' . $posessed[$relation]['primary_key'] . '=' .
				$this->{$relation}->_table . '.' .
				$this->{$relation}->primary_key, $posessed[$relation]['join_type']);

				$columns = $this->{$relation}->get_params('_columns');

				foreach($select as $field)
				{
					if(array_key_exists($field, $columns))
					{
						$this->formatter[] = $columns[$field]['formatter'];
					}
				}

			}
			else
			{

				$this->_database->join($this->{$relation}->_table,
				$this->_table . '.' . $posessed[$relation]['primary_key'] . '=' .
				$this->{$relation}->_table . '.' .
				$this->{$relation}->primary_key);

				$columns = $this->{$relation}->get_params('_columns');

				foreach($select as $field)
				{
					if(array_key_exists($field, $columns))
					{
						$this->formatter[] = $columns[$field]['formatter'];
					}
				}

			}
		}
	}
	function kode_lsp_model()
	{
			return 'tbl007_';

	}
}
