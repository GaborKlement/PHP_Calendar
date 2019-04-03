<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    
    <title>PHP, CSS, MySQL Calendar</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,600,400&subset=latin,latin-ext">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="calendar.css">

</head>

<body>
    
<?php

// Default settings ----------------------------------------------------------------------------------------------------------------------
$month = $_GET['month'];
$year = $_GET['year'];

if (empty($year)) { $year = date("Y"); }
if (empty($month)) { $month = date("m"); }

$time = strtotime('01.'.$month.'.'.$year);
$startWeekDay = date("w", $time);
$maxDays = date("t", $time);
$currentDate = date("d.m.Y", time());
    
$monthArray = array('Jänner', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember');
$monthNumber = $month - 1;
$monthName = $monthArray[$monthNumber];
        
if ($month == 12) {
    $prev = '<a class="prev" href="calendar.php?year='.$year.'&month='.($month - 1).'"><i class="fas fa-chevron-left"></i></a>';
    $next = '<a class="next" href="calendar.php?year='.($year + 1).'&month=1"><i class="fas fa-chevron-right"></i></a>';
}elseif ($month == 1) {
    $prev = '<a class="prev" href="calendar.php?year='.($year - 1).'&month=12"><i class="fas fa-chevron-left"></i></a>';
    $next = '<a class="next" href="calendar.php?year='.$year.'&month='.($month + 1).'"><i class="fas fa-chevron-right"></i></a>';
} else {
    $prev = '<a class="prev" href="calendar.php?year='.$year.'&month='.($month - 1).'"><i class="fas fa-chevron-left"></i></a>';
    $next = '<a class="next" href="calendar.php?year='.$year.'&month='.($month + 1).'"><i class="fas fa-chevron-right"></i></a>';
}
    
$eventsArray = array("12.04.2019", "23.04.2019", "18.05.2019");
    
//------------------------------------------------------------------------------------------------------------------------------------------    
    
?>

<section class="mounth">
  <header>
    <h1><?php echo $monthName.' '.$year; ?></h1>
    <nav role='pagination'>
      <span><?php echo $prev; ?></span>
      <span><?php echo $next; ?></span>
    </nav>
  </header>

  <article>
    <div class="days">
      <b>MO</b>
      <b>DI</b>
      <b>MI</b>
      <b>DO</b>
      <b>FR</b>
      <b>SA</b>
      <b>SO</b>
    </div>
    <div class="dates">

<?php

// Create Days --------------------------------------------------------------------------------------------
 
for ($i = 1; $i <= $maxDays; $i++) {
    
    $datum_temp = $i.'.'.$month.'.'.$year;
    $cDate = date("d.m.Y", strtotime($datum_temp));
    
    $dayNum = date("w", strtotime($datum_temp));
    if ($dayNum == 0) { $dayNum = 7; }
    
    $empty_cells = $dayNum - $i;
    
    if ($empty_cells > 0 && $i == 1) {
        $d = date("t", strtotime("01.".($month-1).".".$year)) - ($empty_cells - 1);
        for ($n = 0; $n < $empty_cells; $n++) {
            echo '<span class="disable">'.$d.'</span>';
            $d++;
        }
    }
    if ($cDate == $currentDate) {
        echo '<span class="active">'.$i.'</span>';
    } else {
        if (in_array($cDate, $eventsArray)) {
        //  echo '<span class="event">'.$i.'</span>';
            echo '<span>'.$i.'<div class="badge"></div></span>';
        } else {
            echo '<span>'.$i.'</span>';
        }
    }
    
    $empty_cells = 7 - $dayNum;
    
    if ($empty_cells > 0 && $i == $maxDays) {
        $d = 1;
        for ($n = 0; $n < $empty_cells; $n++) {
            echo '<span class="disable">'.$d.'</span>';
            $d++;
        }
    }
    
    $empty_cells = 0;
}
        
//-------------------------------------------------------------------------------------------------------------

?>    
        
    </div>
  </article>
</section>
    
</body>
</html>