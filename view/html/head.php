<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Helpdesk</title>

<?php 
    $data = new DateTime();
    $vs = $data->format('YmdHis');
    $tecnico = false;
    if(str_contains($_SERVER['REQUEST_URI'],'/admin')){
        $tecnico = true;
    }
 ?>
<link rel="stylesheet" href="/helpdesk/view/css/styles.css?v=<?php echo $vs; ?>">