<?php
// redirect search/users to users/search
header("Location: /users/search?keyword={$_GET['keyword']}" );
exit;