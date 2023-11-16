<!DOCTYPE html>
<html>
<head>
    <title>Index</title>
    <!-- Bootstrap CSS from CDN (jsDelivr) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1><?php echo lang('index_heading');?></h1>
    <p><?php echo lang('index_subheading');?></p>

    <div id="infoMessage" class="alert alert-info"><?php echo $message;?></div>

    <table class="table">
        <thead>
            <tr>
                <th><?php echo lang('index_fname_th');?></th>
                <th><?php echo lang('index_lname_th');?></th>
                <th><?php echo lang('index_email_th');?></th>
                <th><?php echo lang('index_groups_th');?></th>
                <th><?php echo lang('index_status_th');?></th>
                <th><?php echo lang('index_action_th');?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user):?>
            <tr>
                <td><?php echo htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8');?></td>
                <td><?php echo htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8');?></td>
                <td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8');?></td>
                <td>
                    <?php foreach ($user->groups as $group):?>
                        <div><?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8')) ;?></div>
                    <?php endforeach?>
                </td>
                <td>
                    <?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/".$user->id, lang('index_inactive_link'));?>
                </td>
                <td><?php echo anchor("auth/edit_user/".$user->id, 'Edit') ;?></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>

    <p>
        <?php echo anchor('auth/create_user', lang('index_create_user_link'))?> |
        <?php echo anchor('auth/create_group', lang('index_create_group_link'))?>
    </p>
</div>

<!-- Bootstrap JS from CDN (jsDelivr) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
