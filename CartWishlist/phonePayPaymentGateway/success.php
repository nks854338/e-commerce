<html>

<head>
  <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
</head>
<style>
  body {
    text-align: center;
    padding: 40px 0;
    background: #EBF0F5;
  }

  h1 {
    color: #fc6a03;
    font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
    font-weight: 900;
    font-size: 40px;
    margin-bottom: 10px;
  }

  p {
    color: #404F5E;
    font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
    font-size: 20px;
    margin: 0;
  }

  i {
    color: #fc6a03;
    font-size: 100px;
    line-height: 200px;
    margin-left: -15px;
  }

  .card {
    background: white;
    padding: 60px;
    border-radius: 4px;
    box-shadow: 0 2px 3px #C8D0D8;
    display: inline-block;
    margin: 0 auto;
  }
</style>

<body>
  <div class="card">
  <div class="cut" style="float: right; position: relative; top: -80px; right: -80px; padding: 30px;">
        <div class="cartRemove">
          <button
            style="height: 40px; width: 40px; border-radius: 50%; border: none"
          >
            <a href="http://localhost/projects/e-commerce/index.php">
              <img src="/projects/e-commerce/image/x_mark.png" height="18px" alt="" />
            </a>
          </button>
        </div>
      </div>
    <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
      <i class="checkmark">✓</i>
    </div>

    <h1>Confirm</h1>
    <p>Transaction ID : <?php echo $_GET['tid']; ?></p>
    <p>Amount : <?php echo $_GET['amount'] / 100; ?></p>
    <p>We received your purchase request;<br /> we'll be in touch shortly!</p>
  </div>
</body>

</html>