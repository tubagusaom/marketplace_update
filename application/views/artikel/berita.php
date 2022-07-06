<style>
@import url(https://fonts.googleapis.com/css?family=Oswald:400,300,700);
@import url(https://fonts.googleapis.com/css?family=Abel);
body.opened, html.opened{
  overflow:hidden;
  position: relative;
  height: 100%;
}
ul {
  margin: 0;
  padding: 0;
  list-style-type: none;
}

ul.newslinks a {
  text-decoration: none;
}

nav .newsnav {
  height: 35px;
  background: rgb(128, 199, 201);
}

nav .newsnav #recentnews {
  font-family: 'Abel';
  font-size: 20px;
  height: 100%;
  padding: 0 14px 0 8px;
  background: rgb(75, 35, 182);
  color: #fff;
  float: left;
}

nav .newsnav #recentnews i {
  margin: 8px;
}

ul.newslinks {
  float: right;
}

.newslinks a {
  float: left;
  padding: 6px 10px 0 10px;
  color: #fff;
  font-family: 'Abel';
  font-size: 16px;
  height: 35px;
  position: relative;
  transition: color .3s ease-in-out;
}

.newslinks a:hover {
  color: aqua;
  text-decoration: none;
}

.newslinks a:after {
  content: '';
  position: absolute;
  left: 0;
  bottom: 0;
  display: block;
  height: 2px;
  width: 0;
  background: #102857;
  transition: width .3s ease-in-out;
}

.newslinks a:hover:after {
  width: 100%;
}

.newslinks a.more-links {
  display: none;
}

.newsnav .search {
  background: #102857;
  padding: 5px 16px;
  width: 80px;
  height: 35px;
  float: right;
  color: #fff;
  font-family: 'Abel';
  font-size: 18px;
  cursor: pointer;
}

.newsnav .search:hover {
  color: rgb(128, 199, 201);
}

nav .searchnav {
  height: 0;
  overflow: hidden;
  background: #102857;
  transition: height .3s ease-in-out;
}

nav .searchnav ul {
  float: right;
  display: block;
}

nav .searchnav li {
  color: #fff;
  float: left;
  padding: 7px 8px 0 8px;
  height: 35px;
  cursor: pointer;
  position: relative;
  transition: color .3s ease-in-out;
  font-family: 'Abel';
  font-size: 16px;
}

nav .searchnav li:hover {
  color: rgb(128, 199, 201);
}

nav .searchnav li:after {
  content: '';
  position: absolute;
  left: 0;
  bottom: 0;
  display: block;
  height: 2px;
  width: 0;
  background: rgb(128, 199, 201);
  transition: width .3s ease-in-out;
}

nav .searchnav li:hover:after {
  width: 100%;
}

nav .searchnav li.close-search {
  font-size: 18px;
  padding: 5px 12px;
}

nav .searchnav li.close-search:after {
  display: none;
}

nav .searchnav li.search-field {
  font-family: sans-serif;
  font-size: 12px;
  color: #000;
}

nav .searchnav li.search-field:hover {}

nav .searchnav li input {
  height: 80%;
  border: none;
  padding: 0 5px 0 5px;
  width: 400px;
}

nav .searchnav li.search-field:after {
  display: none;
}

nav .searchnav.opened {
  height: 35px;
}

.archive {
  display: block;
  padding-top: 15px;
  position: absolute;
  z-index: 6000;
  background: #fff;
  height: 0;
  overflow: hidden;
  left: 0;
  transition: height .4s ease-in-out;
  width: 100%;
}

.archive.opened {
  height: 370px;
}

.archive #active-article .contain {
  min-height: 50px;
  max-height: 250px;
  overflow: hidden;
}

.archive #active-article img {
  width: 100%;
}

.archive #active-article .info p {
  margin-top: 6px;
}

ul#archive-list {
  font-family: 'Oswald';
  font-size: 16px;
  height: 350px;
  overflow: scroll;
  overflow-x: hidden;
}

#archive-list li {
  padding: 5px;
  color: #002743;
}

#archive-list #date {
  color: rgb(128, 199, 201);
  display: inline-block;
  margin-right: 6px;
}

#archive-list li:hover #date {
  color: #fff;
}

#archive-list #title {
  display: inline-block;
}

#archive-list li:hover {
  background: rgb(128, 199, 201);
  color: #fff;
}

#archive-list #date.new {
  color: #102857;
}

#archive-list:hover #date.new {
  color: #102857;
}
article.style1 {
  position: relative;
  height: auto;
  min-height:150px;
  overflow: hidden;
  margin-top: 15px;
}

article img {
  opacity:0;
  width:100%;
  height: 199.828px;
  z-index: 2;
  margin: 0 0 0 0;
  filter: grayscale(100%);
  transition: transform .4s ease-in-out, margin .4s ease-in-out, filter .4s ease-in-out;
}
article img.show{
  opacity:1;
}

article .loader {
  position: absolute;
  left: calc(50% - 25px);
  top: calc(50% - 25px);
  color: rgb(128, 199, 201);
  font-size: 50px;
  z-index: 0;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  100% {
    transform: rotate(360deg);
  }
}

article.style1:hover img {
  margin: 0 0 0 0%;
  transform:scale(1.15);
  filter: grayscale(0%);
}

article.style1 .date {
  position: absolute;
  z-index: 3;
  left: 0;
  width: 50px;
  height: 30px;
  background: #102857;
  font-family: 'Oswald';
  font-style: normal;
  font-size: 18px;
  text-transform: uppercase;
  text-align: center;
  color: #fff;
  padding-top: 3px;
}

article.style1 .date.old {
  padding-top: 2px;
  background: rgb(128, 199, 201);
}

article.style1 .date.old:before {
  font-size: 14px;
}

article.style1 .content {
  position: absolute;
  height: auto;
  width: 100%;
  bottom: 0;
  left: 0;
  z-index: 4;
}

article.style1 .title {
  bottom: 0;
  left: 0;
  width: 100%;
  height: 30px;
  background: #102857;
  font-family: 'Oswald';
  font-style: normal;
  font-size: 14px;
  text-align: left;
  padding: 5px;
  color: #fff;
  transition: background .4s ease-in-out;
}

article.style1:hover .title {
  background: rgb(128, 199, 201);
}

article.style1 i.share {
  position: absolute;
  right: 0;
  font-size: 18px;
  padding: 2px 8px;
  transition: all .2s ease-in-out;
}

article.style1 i.share:hover {
  color: #102857;
}

article.style1 .info {
  bottom: 0;
  left: 0;
  width: 100%;
  max-height: 0;
  background: #102857;
  text-align: left;
  overflow: hidden;
  transition: max-height .3s ease-in-out, color .4s ease-in-out;
}

article.style1 .info p {
  padding: 5px;
  font-family: sans-serif;
  font-style: normal;
  font-size: 12px;
  color: #fff;
}

article.style1:hover .info {
  max-height: 75px;
  color: #fff;
}


/*Style2*/

article.style2 {
  position: relative;
  height: auto;
  min-height:150px;
  overflow: hidden;
  margin-top: 15px;
}

article.style2:hover img {
  margin: 0 0 0 0%;
  transform:scale(1.15);
  filter: grayscale(0%);
}

article.style2 .date {
  position: absolute;
  z-index: 2;
  left: 0;
  width: 50px;
  height: 30px;
  background: #102857;
  font-family: 'Oswald';
  font-style: normal;
  font-size: 18px;
  text-transform: uppercase;
  text-align: center;
  color: #fff;
  padding-top: 3px;
}

article.style2 .date.old {
  padding-top: 2px;
  background: rgb(128, 199, 201);
}

article.style2 .date.old:before {
  font-size: 14px;
}

article.style2 .content {
  position: absolute;
  height: auto;
  width: 100%;
  bottom: 0;
  left: 0;
  z-index: 3;
}

article.style2 .title {
  bottom: 0;
  left: 0;
  margin-left: 50px;
  width: 100%;
  height: 30px;
  background: rgba(0, 85, 150, .75);
  font-family: 'Oswald';
  font-style: normal;
  font-size: 12px;
  text-align: left;
  padding: 6px;
  color: #fff;
  transition: background .4s ease-in-out;
}

article.style2:hover .title {
  background: rgba(0, 85, 150, 1);
}

article.style2 .share {
  font-family: 'Oswald';
  position: absolute;
  right: -70px;
  top: -28px;
  padding: 2px;
  width: 70px;
  font-size: 14px;
  transition: all .2s ease-in-out;
  color: #fff;
  background: rgba(0, 85, 150, 1);
}

article.style2 .share i {
  margin: 5px;
  font-size: 15px;
}

article.style2:hover .share {
  right: 0;
}

article.style2 .share:hover {
  color: #102857;
}

article.style2 .info {
  bottom: 0;
  left: 0;
  width: 100%;
  max-height: 0;
  background: #102857;
  text-align: left;
  overflow: hidden;
  transition: max-height .3s ease-in-out, color .4s ease-in-out;
}

article.style2:hover .info {
  max-height: 75px;
  color: #fff;
}

article.style2 .info p {
  padding: 5px;
  font-family: sans-serif;
  font-style: normal;
  font-size: 12px;
  color: #fff;
}

.newsbottom {
  position: fixed;
  z-index: 1000;
  bottom: 0;
  height: 80px;
  width: 100%;
  pointer-events: none;
  background: rgba(0, 0, 0, 0);
  background: -moz-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.43) 57%, rgba(0, 0, 0, 0.54) 71%, rgba(0, 0, 0, 0.57) 75%, rgba(0, 0, 0, 0.9) 100%);
  background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(0, 0, 0, 0)), color-stop(57%, rgba(0, 0, 0, 0.43)), color-stop(71%, rgba(0, 0, 0, 0.54)), color-stop(75%, rgba(0, 0, 0, 0.57)), color-stop(100%, rgba(0, 0, 0, 0.9)));
  background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.43) 57%, rgba(0, 0, 0, 0.54) 71%, rgba(0, 0, 0, 0.57) 75%, rgba(0, 0, 0, 0.9) 100%);
  background: -o-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.43) 57%, rgba(0, 0, 0, 0.54) 71%, rgba(0, 0, 0, 0.57) 75%, rgba(0, 0, 0, 0.9) 100%);
  background: -ms-linear-gradient(top, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.43) 57%, rgba(0, 0, 0, 0.54) 71%, rgba(0, 0, 0, 0.57) 75%, rgba(0, 0, 0, 0.9) 100%);
  background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.43) 57%, rgba(0, 0, 0, 0.54) 71%, rgba(0, 0, 0, 0.57) 75%, rgba(0, 0, 0, 0.9) 100%);
  filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#000000', endColorstr='#000000', GradientType=0);
}

.newsbottom .to-top {
  position: absolute;
  right: 15px;
  bottom: 15px;
  width: 40px;
  height: 40px;
  background: rgb(128, 199, 201);
  pointer-events: all;
  cursor: pointer;
}

.newsbottom .to-top i {
  color: #fff;
  font-size: 20px;
  margin: 10px;
}

@media (max-width: 650px) {
  .col-xxs-12 {
    width: 100%;
  }
  .hidden-xxs {
    display: none;
  }
  article.style1:hover .info, article.style2:hover .info {
    max-height: 0px;
  }
  article img {
    filter: grayscale(0%);
  }
  article.style1:hover img, article.style2:hover img{
    width: 100%;
  margin: 0 0 0 0;
  }
  article.style2 .share {
  right: 0;
}
}

@media (max-width:768px) {
  .archive #active-article {
    display: none;
  }
}

@media (max-width: 992px) {
  ul.newslinks {
    background: rgb(128, 199, 201);
    padding: 0 15px;
    max-height: 35px;
    overflow: hidden;
    transition: max-height .3s ease-in-out;
    position: absolute;
    right: 90px;
    z-index: 10000;
  }
  .newslinks a {
    float: none;
    background: rgb(128, 199, 201);
    padding: 0 0;
    color: #fff;
    font-family: 'Abel';
    font-size: 16px;
    height: 35px;
    position: relative;
    transition: color .3s ease-in-out;
    line-height: 35px;
  }
  ul.newslinks:hover {
    max-height: 250px;
  }
  .newslinks a.more-links {
    display: block;
  }
  .newslinks a.more-links:hover {
    color: #fff;
  }
  .newslinks a.more-links:after {
    display: none;
  }
  nav .searchnav.opened {
    height: 70px;
  }
  nav .searchnav ul {
    float: left;
    width: 100%;
  }
  nav .searchnav li.search-field {
    width: 100%;
  }
  nav .searchnav li.close-search {
    position: absolute;
    right: 12px;
  }
  nav .searchnav li.search-field input {
    width: 100%;
  }
}
@media (max-width: 1200px) {

}
@media (max-width: 1600px) {

}
</style>
<section class="latestSection container-fluid-full">

<div class='container-fluid'>
  <div class='row'>
    <nav class='col-xs-12'>
      <div class='newsnav'>
        <div id='recentnews'><i class="fa fa-newspaper-o"></i><span class='hidden-xxs'>BERITA TERBARU</span></div>
      </div>
    </nav>
  </div>

  <div class='row'>
    <div class="col-xs-12">
    <!--STYLE1-->
    <?php
    $step = 0; 
    foreach ($berita_lsp_pilihan as $key => $value) { ?>
    <a href='<?=base_url()."profile/index/".$value->id?>' class='col-md-3'>
      <article class="style1 appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="<?= $step += 150; ?>">
        <div class='date'>  NEWS </div>
        <!--must have larger width than height-->
        <i class="loader fa fa-spinner"></i>
        <img class='lazy' data-original='<?=base_url().'assets/files/artikel/'.$value->foto?>'>
        <div class='content'>
          <!--32 charecter max-->
          <div class='title'>
            <?=substr($value->headline,0,20)?>...<i class="share fa fa-share-square-o"></i>
          </div>
          <div class='info'>
            <p><?=$value->headline?></p>
          </div>
        </div>
      </article>
    </a>
    <?php } ?>
    </div>
  </div>
</div>


      </section>
<script type="text/javascript">
$(function() {

  $('img').load(function(){
     $(this).addClass('show')
  });

});

/*! Lazy Load 1.9.1 - MIT license - Copyright 2010-2013 Mika Tuupola */
! function(a, b, c, d) {
  var e = a(b);
  a.fn.lazyload = function(f) {
    function g() {
      var b = 0;
      i.each(function() {
        var c = a(this);
        if (!j.skip_invisible || c.is(":visible"))
          if (a.abovethetop(this, j) || a.leftofbegin(this, j));
          else if (a.belowthefold(this, j) || a.rightoffold(this, j)) {
          if (++b > j.failure_limit) return !1
        } else c.trigger("appear"), b = 0
      })
    }
    var h, i = this,
      j = {
        threshold: 0,
        failure_limit: 0,
        event: "scroll",
        effect: "show",
        container: b,
        data_attribute: "original",
        skip_invisible: !0,
        appear: null,
        load: null,
        placeholder: ""
      };
    return f && (d !== f.failurelimit && (f.failure_limit = f.failurelimit, delete f.failurelimit), d !== f.effectspeed && (f.effect_speed = f.effectspeed, delete f.effectspeed), a.extend(j, f)), h = j.container === d || j.container === b ? e : a(j.container), 0 === j.event.indexOf("scroll") && h.bind(j.event, function() {
      return g()
    }), this.each(function() {
      var b = this,
        c = a(b);
      b.loaded = !1, (c.attr("src") === d || c.attr("src") === !1) && c.is("img") && c.attr("src", j.placeholder), c.one("appear", function() {
        if (!this.loaded) {
          if (j.appear) {
            var d = i.length;
            j.appear.call(b, d, j)
          }
          a("<img />").bind("load", function() {
            var d = c.attr("data-" + j.data_attribute);
            c.hide(), c.is("img") ? c.attr("src", d) : c.css("background-image", "url('" + d + "')"), c[j.effect](j.effect_speed), b.loaded = !0;
            var e = a.grep(i, function(a) {
              return !a.loaded
            });
            if (i = a(e), j.load) {
              var f = i.length;
              j.load.call(b, f, j)
            }
          }).attr("src", c.attr("data-" + j.data_attribute))
        }
      }), 0 !== j.event.indexOf("scroll") && c.bind(j.event, function() {
        b.loaded || c.trigger("appear")
      })
    }), e.bind("resize", function() {
      g()
    }), /(?:iphone|ipod|ipad).*os 5/gi.test(navigator.appVersion) && e.bind("pageshow", function(b) {
      b.originalEvent && b.originalEvent.persisted && i.each(function() {
        a(this).trigger("appear")
      })
    }), a(c).ready(function() {
      g()
    }), this
  }, a.belowthefold = function(c, f) {
    var g;
    return g = f.container === d || f.container === b ? (b.innerHeight ? b.innerHeight : e.height()) + e.scrollTop() : a(f.container).offset().top + a(f.container).height(), g <= a(c).offset().top - f.threshold
  }, a.rightoffold = function(c, f) {
    var g;
    return g = f.container === d || f.container === b ? e.width() + e.scrollLeft() : a(f.container).offset().left + a(f.container).width(), g <= a(c).offset().left - f.threshold
  }, a.abovethetop = function(c, f) {
    var g;
    return g = f.container === d || f.container === b ? e.scrollTop() : a(f.container).offset().top, g >= a(c).offset().top + f.threshold + a(c).height()
  }, a.leftofbegin = function(c, f) {
    var g;
    return g = f.container === d || f.container === b ? e.scrollLeft() : a(f.container).offset().left, g >= a(c).offset().left + f.threshold + a(c).width()
  }, a.inviewport = function(b, c) {
    return !(a.rightoffold(b, c) || a.leftofbegin(b, c) || a.belowthefold(b, c) || a.abovethetop(b, c))
  }, a.extend(a.expr[":"], {
    "below-the-fold": function(b) {
      return a.belowthefold(b, {
        threshold: 0
      })
    },
    "above-the-top": function(b) {
      return !a.belowthefold(b, {
        threshold: 0
      })
    },
    "right-of-screen": function(b) {
      return a.rightoffold(b, {
        threshold: 0
      })
    },
    "left-of-screen": function(b) {
      return !a.rightoffold(b, {
        threshold: 0
      })
    },
    "in-viewport": function(b) {
      return a.inviewport(b, {
        threshold: 0
      })
    },
    "above-the-fold": function(b) {
      return !a.belowthefold(b, {
        threshold: 0
      })
    },
    "right-of-fold": function(b) {
      return a.rightoffold(b, {
        threshold: 0
      })
    },
    "left-of-fold": function(b) {
      return !a.rightoffold(b, {
        threshold: 0
      })
    }
  })
}(jQuery, window, document);

$(function() {
  $("img.lazy").lazyload();
});
</script>
