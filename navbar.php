<?php

    $name = $_SESSION['Name'];
?>


<div class="navbar">
	<div class="welcome">
          
          <h1 id="UserId">Welcome!<?php echo strtoupper($name); ?></h1>
        </div>

        <nav>
          <ul>
            <li><a href="homepage.php">HOME<iconify-icon icon="ion:home"></iconify-icon></a></li>
            <li><a href="../index.php">LOGOUT<iconify-icon icon="clarity:logout-solid"></iconify-icon></a></li>
          </ul>
          <div class="datetime">
          <div class="date">
            <span id="month">Month</span>
            <span id="daynum">00</span>
            <span id="year">Year</span>
            <span id="dayname">Day</span>
          </div>

          <div class="time">
            <span id="hour">00</span>
            <a>:</a>
            <span id="minutes">00</span>
            <a>:</a>
            <span id="seconds">00</span>
            <span id="period">AM</span>
          </div>
        </div>
        </nav>

        
	</div>

  <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
  
