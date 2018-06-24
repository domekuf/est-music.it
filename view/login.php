<?php echo $this->fetch("/head.php", []);?>
<div class="row h-100 align-items-center" style="background:url('<?=RT?>img/bg-01.jpg');background-size:cover">
<div class="col-12 col-md-6 offset-md-3 text-light text-center bg-dark" style="opacity:0.8">
    <h1 class="h3 mb-3 font-weight-normal">Login</h1>
    <form>
    <div class="form-group">
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
    </div>
    <div class="form-group">
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
    </div>
    </form>
</div>
</div>
<?php echo $this->fetch("/foot.php", []);?>
