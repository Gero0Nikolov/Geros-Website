<div class="content-container animated fadeIn">
    <?php 
    get_view( "search" ); 
    
    $booker = isset( $_GET[ "b" ] ) && !empty( $_GET[ "b" ] ) ? $_GET[ "b" ] : "";

    $page_id = get_the_ID();
    $data = new stdClass;
    $data->name = get_field( "name_placeholder", $page_id );
    $data->email = get_field( "email_placeholder", $page_id );
    $data->reasons = get_field( "reasons", $page_id );
    $data->message = get_field( "message_placeholder", $page_id );
    $data->notification = get_field( "notification_text", $page_id );
    $data->button = get_field( "button_placeholder", $page_id );
    ?>
    <div id="contactme-container" class="contactme-container padding-side">
        <input id="name" type="text" placeholder="<?php echo $data->name; ?>">
        <input id="email" type="email" placeholder="<?php echo $data->email; ?>">
        <select id="reason">
            <?php 
            foreach ( $data->reasons as $reason ) {
                ?>

                <option value="<?php echo $reason[ "reason" ]; ?>" <?php echo $booker == $reason[ "reason" ] ? "selected='selected'" : ""; ?>><?php echo $reason[ "label" ]; ?></option>

                <?php
            }
            ?>
        </select>
        <textarea id="message" placeholder="<?php echo $data->message; ?>"></textarea>
        <div class="message">
            <?php echo $data->notification; ?>
        </div>
        <button id="send"><?php echo $data->button; ?></button>
    </div>
</div>