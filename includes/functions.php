<?php

function confirm_query($arg)
    {
        if (!$arg)
        {
            die("Error : could not get table" . mysql_error());            
        }
    }
    
function redirect_to ($location)
    {
        if (isset ($location))
        {
            header ("location:{$location}");
            exit;
        }
    }
function recent_post ($flag=1)
{
    global $connection;
    $query2 = "(SELECT DISTINCT post_id,time
                FROM comments
                ORDER BY comments.time DESC
                )
                UNION ( SELECT DISTINCT post_id,time
                FROM posts
                ORDER BY posts.time DESC
                )
                ORDER BY time DESC";
    $result_set2 = mysql_query($query2);
                
    while ($post_id11 = mysql_fetch_array($result_set2))
    {
        $query3 = "INSERT INTO `dfolt`.`temp` (`post_id` ,`time`)VALUES ('{$post_id11[0]}', '{$post_id11[1]}');";
        mysql_query($query3);
    }
    $query = "SELECT distinct post_id FROM `temp` where post_id <> 2 order by time desc";
    if ($flag == 2)
    {
                $query.= " LIMIT 10";
    }
    $res = mysql_query($query);
    $fquery = "truncate temp;";
    mysql_query($fquery);
    
    return $res;
}
function get_by_postid($postid)
{
     global $connection;
     $query = "SELECT *
                    FROM `posts`
                    WHERE `post_id` = $postid
                    LIMIT 1";
    if ($result_set = mysql_query($query))
    {
        return $result_set;
    }
    else
    {
        die("Query Failed " . mysql_error());
    }
    
}

function get_comments_by_postid($postid)
{
    global $conneciton;
    $query = "SELECT *
                FROM `comments`
                WHERE `post_id` ={$postid}
                ORDER BY `time` DESC ;";
    
    if ($result_set = mysql_query($query))
    {
        return $result_set;
    }
    else
    {
        die("Query Failed " . mysql_error());
    }
        
}

function add_comment($postid1,$uid1,$comment1)
{
    global $conneciton;
    $postid = mysql_prep($postid1);
    $uid = mysql_prep($uid1);
    $comment = mysql_prep($comment1);
    $dt = date("y-m-d H:i:s", time()) ;
    $query = "INSERT INTO `dfolt`.`comments` (`comment_id` ,`post_id` ,`content` ,`user_id` ,`time`)
                VALUES (NULL , '{$postid}', '{$comment}', '{$uid}', '{$dt}')";
    
    if (!mysql_query($query))
    {
        die("Insertion Failed " . mysql_error());
    }

}

function add_post($title1,$post1)
{
    global $conneciton;
    $title = mysql_prep($title1);
    $post = mysql_prep($post1);
    $dt = date("y-m-d H:i:s", time()) ;
    $query = " INSERT INTO `dfolt`.`posts`
                (`post_id` ,`title` ,`content` ,`user_id` ,`time`)
                    VALUES (NULL ,\"{$title}\" , \"{$post}\", \"{$_SESSION['user_id']}\", \"{$dt}\");";
    
    if (!mysql_query($query))
    {
        die("Insertion Failed " . mysql_error());
    }

}

function delete_by_id($id,$set)
{
    global $connection;
    if ($set == 2)
    {
        $query = "DELETE FROM `comments`
                    WHERE `comments`.`comment_id` = {$id} LIMIT 1 ";
                    
        if (!mysql_query($query))
        {
            die("Query Failed " . mysql_error());
        }
    }
    
    elseif ($set == 1)
    {
        $query = "DELETE FROM `posts`
                    WHERE `posts`.`post_id` = {$id} LIMIT 1";
        $query2 = "DELETE FROM `comments`
                    WHERE `comments`.`post_id` = {$id}; ";
        if (!mysql_query($query))
        {
            die("Query Failed " . mysql_error());
        }
        if (!mysql_query($query2))
        {
            die("Query Failed " . mysql_error());
        }
    }
    
    
}

function get_user_list()
{
    $query = "SELECT * FROM `users`";
    if ($result_set = mysql_query($query))
    {
        return $result_set;
    }
    else
    {
        die("Query Failed " . mysql_error());
    }
    
}

function getdetail($post_id)
{
    global $connection;
    $query = "SELECT `user_id` , `title` , `content` , `time`, `post_id`
                FROM `posts` where post_id={$post_id}";
    if ($result_set = mysql_query($query))
    {
        return $result_set;
    }
    else
    {
        die("Query Failed " . mysql_error());
    }
}

function mysql_prep($value)
{
    $magic_quotes_active = get_magic_quotes_gpc();
    $new_enough_php = function_exists("mysql_real_escape_string");//i.e. PHP >=v.4.3.0
    if($new_enough_php){
        if($magic_quotes_active)
        {
            $value = stripcslashes($value);
        }
        $value = mysql_real_escape_string($value);
    }
    else
    {
        if(!$magic_quotes_active)
        {
            $value = addslashes($value);
        }
    }
    return $value;
}

function get_no_of_comments($pi)
{
    $query = "select count(*) from comments where post_id={$pi}";
    if ($result_set = mysql_query($query))
    {
        $result = mysql_fetch_array($result_set);
        return $result[0];
    }
    else
        return 0;
}

?>