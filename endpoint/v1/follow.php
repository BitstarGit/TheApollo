<?php
if (IS_LOGGED == false) {
    $data = array(
        'status' => 400,
        'errors' => array(
            'error_id' => '1',
            'error_text' => 'Not logged in'
        )
    );
    echo json_encode($data);
    exit();
}
if (!empty($_POST['user_id']) && !empty($_POST['follower_id'])) {
    $id = Secure($_POST['user_id']);
    $is_followed = $db->where('user_id', $id)->where('follower_id', $user->id)->getValue(T_FOLLOWERS, "count(*)");

    if ($is_followed > 0) {
        $delete_fol = $db->where('user_id', $id)->where('follower_id', $user->id)->delete(T_FOLLOWERS);
        $delete_fol = $db->where('recipient_id', $id)->where('type', 'followed_u')->where('notifier_id', $user->id)->delete(T_NOTIFICATIONS);
        if ($delete_fol) {
            $data = array(
                'status' => 200,
                'message' => 'follower removed'
            );
        }

    }
    else {
        $insert_data         = array(
            'user_id' => $id,
            'follower_id' => $user->id,
            'time' => time()
        );
        if( $id == $user->id ) {
            $create_following = $db->insert(T_FOLLOWERS, $insert_data);
            if ($create_following) {
                $data = array(
                    'status' => 200,
                    'message'=> 'follow successiful'
                );

                $notif_data = array(
                    'notifier_id' => $ask->user->id,
                    'recipient_id' => $id,
                    'type' => 'followed_u',
                    'url' => ('@' . $ask->user->username),
                    'time' => time()
                );

                Notify($notif_data);
            }
        }else{
            $data = array(
                'status' => 304
            );
        }
    }
} else {
    $data = array(
        'status' => 400,
        'errors' => array(
            'error_id' => '1',
            'error_text' => 'Invalid User Id'
        ) );
}