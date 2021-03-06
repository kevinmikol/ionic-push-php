<?php
use Tomloprod\IonicApi\Push;
$ionicPushApi = new Push($ionicProfile, $ionicAPIToken);
?>

<h1>List all notifications and get data:</h1>

<ul>
    <?php
    $notifications = $ionicPushApi->notifications->paginatedList([], true);
    // Sometimes, on fast requests, response could be null.
    if($notifications !== null){
        foreach($notifications->data as $notification){
    ?>
            <li>    
              <p> <b>Notification ID:</b> <?php echo $notification->uuid; ?> </p>
              <p> <b>Title:</b> <?php echo $notification->config->notification->title; ?> </p>
              <p> <b>Message:</b> <?php echo $notification->config->notification->message; ?> </p>
              <p> <b>Created at:</b> <?php echo $notification->created; ?> </p>
              <?php 
                if(property_exists($notification->config, "send_to_all")) {
              ?>
              <p> <b>Send to all!</b> </p>
              <?php
                } else {
              ?>
              <p> <b>Send to tokens:</b> <pre> <?php var_dump($notification->config->tokens); ?> </pre> </p>
              <?php
                }
              ?>
            </li>
    <?php 
        }
    } else {
    ?>
            <li>Response is null!</li>
    <?php
    }
    ?>
</ul>
