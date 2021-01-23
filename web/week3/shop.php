<?php include 'common/header.php'?>
 <?php session_start();?>
<div class="container">
<h1>Books for Sale</h1>
  <!---The Eye of the World-->
  <section class="card h-100">
    <h4>The Eye of the World</h4>
    <img class="covers" src="images/wot1.jpg" alt="The Eye of the World">
    <hr>
    <p>Author:</p>
    <p>Robert Jordan</p>
    <hr>
    <p>Pages:</p>
    <p>670</p>
    <a href="week3/test.php?action=add&itemName=The Eye of the World" class="btn btn-primary">Add to Cart</a>
  </section> <!---The Eye of the World-->
    <!---Harry Potter-->
    <section class="card h-100">
    <h4>Harry Potter</h4>
    <img class="covers" src="images/hpss.jpg" alt="Harry Potter">
    <hr>
    <p>Author:</p>
    <p>J.K. Rowling</p>
    <hr>
    <p>Pages:</p>
    <p>309</p>
    <a href="/cs313-php/web/week3/cart?action=add&itemName=Harry Potter" class="btn btn-primary">Add to Cart</a>
  </section> <!---Harry Potter-->
      <!---Off to be the Wizard-->
      <section class="card h-100">
    <h4>Off to be the Wizard</h4>
    <img class="covers" src="images/otbw.jpg" alt="Off to be the Wizard">
    <hr>
    <p>Author:</p>
    <p>Scott Meyer</p>
    <hr>
    <p>Pages:</p>
    <p>373</p>
    <a  href="/cs313-php/web/week3/cart?action=add&itemName=Off to be the Wizard" class="btn btn-primary">Add to Cart</a>
  </section> <!---Off to be the Wizard-->
  <!---The Shadow of What was Lost-->
  <section class="card h-100">
    <h4>Shadow of What was Lost</h4>
    <img class="covers" src="images/sowwl.jpg" alt="The Shadow of What was Lost">
    <hr>
    <p>Author:</p>
    <p>James Islington</p>
    <hr>
    <p>Pages:</p>
    <p>618</p>
    <a href="/cs313-php/web/week3/cart?action=add&itemName=Shadow of What was Lost" class="btn btn-primary">Add to Cart</a>
  </section> <!---The Shadow of What was Lost-->
  <!---The Philosopher's Flight-->
  <section class="card h-100">
    <h4>The Philosopher's Flight</h4>
    <img class="covers" src="images/tpf.jpg" alt="The Philosopher's Flight">
    <hr>
    <p>Author:</p>
    <p>Tom Miller</p>
    <hr>
    <p>Pages:</p>
    <p>432</p>
    <a href="/cs313-php/web/week3/cart?action=add&itemName=The Philosopher's Flight" class="btn btn-primary">Add to Cart</a>
  </section> <!---The Philosopher's Flight-->
  <!---Son of a Liche-->
  <section class="card h-100">
    <h4>Son of a Liche</h4>
    <img class="covers" src="images/soal.jpg" alt="Son of a Liche">
    <hr>
    <p>Author:</p>
    <p>J. Zachary Pike</p>
    <hr>
    <p>Pages:</p>
    <p>736</p>
    <a href="/cs313-php/web/week3/cart?action=add&itemName=Son of a Liche" class="btn btn-primary">Add to Cart</a>
  </section> <!---Son of a Liche-->
  <!---Theft of Swords-->
  <section class="card h-100">
    <h4>Theft of Swords</h4>
    <img class="covers" src="images/tos.jpg" alt="Theft of Swords">
    <hr>
    <p>Author:</p>
    <p>Michael J. Sullivan</p>
    <hr>
    <p>Pages:</p>
    <p>691</p>
    <a href="/cs313-php/web/week3/cart?action=add&itemName=Theft of Swords" class="btn btn-primary">Add to Cart</a>
  </section> <!---Theft of Swords-->
  <!---Way of Kings-->
  <section class="card h-100">
    <h4>The Way of Kings</h4>
    <img class="covers" src="images/wok1.jpg" alt="The way of kings" id="tall-img">
    <hr>
    <p>Author:</p>
    <p>Brandon Sanderson</p>
    <hr>
    <p>Pages:</p>
    <p>1258</p>
    <a href="/cs313-php/web/week3/cart?action=add&itemName=The Way of Kings" class="btn btn-primary">Add to Cart</a>
  </section> <!---Way of Kings-->
    <!---We are Legion-->
    <section class="card h-100">
    <h4>We are Legion</h4>
    <img class="covers" src="images/wal.jpg" alt="We are Legion">
    <hr>
    <p>Author:</p>
    <p>Dennis E. Taylor</p>
    <hr>
    <p>Pages:</p>
    <p>308</p>
    <a href="/web/week3/cart?action=add&itemName=We are Legion" class="btn btn-primary">Add to Cart</a>
  </section> <!---We are Legion-->
   <!---Will Save the Galaxy for Food-->
   <section class="card h-100">
    <h4>Will Save the Galaxy for Food</h4>
    <img class="covers" src="images/wsgff.jpg" alt="Will Save the Galaxy for Food">
    <hr>
    <p>Author:</p>
    <p>Yahtzee Croshaw</p>
    <hr>
    <p>Pages:</p>
    <p>286</p>
    <a href="/cart?action=add&itemName=Will Save the Galaxy for Food" class="btn btn-primary">Add to Cart</a>
  </section> <!---Will Save the Galaxy for Food-->


</div><!---end container-->


<?php include 'common/footer.php'; ?>