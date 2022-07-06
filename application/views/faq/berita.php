<div class="container" style="margin-top: 30px;">
<div class="row">
<div class="col-md-3">

<div class="well" style="margin-bottom: 150px;">
    <h5>ANOUNCEMENT</h5>
    <ul style="margin-left: -25px;">
        <?php
            foreach($berita as $value){
                echo "<li><a href='".base_url()."welcome/berita/".$value['id']."'>".$value['headline']."</a></li>";
            }
        ?>
    </ul>
    <a href="#" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-list"></span> More Detail</a>
    
</div>              
                
</div>
<div class="col-md-9">
<ol class="breadcrumb" style="margin-bottom: 5px;">
  <li><a href="<?php echo base_url()?>">Home</a></li>
  <li><a href="#">Berita</a></li>
  <li class="active">
  <?php echo $detail_berita->title ;?>
  </li>
</ol>
<?php
echo "<h3>".$detail_berita->title."</h3>";
?>
<img src="<?php echo base_url().'assets/img/berita.jpg';?>" class="img-thumbnail" />
<?php
echo "<p>".$detail_berita->content."</p>";
?>                
<div id="disqus_thread"></div>
<script>
    /**
     *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
     *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
     */
    /*
    var disqus_config = function () {
        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    */
    (function() {  // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        
        s.src = '//aeroflyer.disqus.com/embed.js';
        
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>                
</div>
</div>
</div>
