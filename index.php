<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <title>The Arena test task</title>
      <meta name="viewport" content="width=device-width">
      <link rel="stylesheet" href="css/style.css" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   </head>
   <body>
   <?php
   require_once( dirname( __FILE__ ) . '/class-actor.php' );
   require_once( dirname( __FILE__ ) . '/class-movie.php' );
   require_once( dirname( __FILE__ ) . '/config.php' );
   require_once( dirname( __FILE__ ) . '/class-memory-mysql.php' );
   require_once( dirname( __FILE__ ) . '/srv_functions.php' );
   $first_actor=new Actor(false,'James Belushi','1962/11/01');
   $second_actor=new Actor(false,'Eddy Murphy','1963/12/02');
   $third_actor=new Actor(false,'Malcolm McDowell','1933/12/01');
   $fourh_actor=new Actor(false,'Charlie Chaplin','1899/12/01');

   $first_movie=new Movie(false,'Apocalypse Now',1962,136);
   $second_movie=new Movie(false,'The Shawshank Redemption',1982,152);
   $second_movie->add_actor($first_actor,'Pinocchio');
   $second_movie->add_actor($second_actor,'Killer');
   $second_movie->add_actor($third_actor,['Ant','Bear']);
   $second_movie->add_actor($fourh_actor,['Wolf','Fox']);

   $second_a_json=$second_actor->get_json();
   $second_m_json=$second_movie->get_json();

   $youngest_actors=$second_movie->get_youngest_list();

   myvar_dump($first_actor,'$first_actor_sdasdas');
   myvar_dump($second_actor,'$second_actor_sfasfa');
   myvar_dump($second_a_json,'$second_a_json_sfasfa');
   myvar_dump($youngest_actors,'$youngest_actors_sfasfa');

   myvar_dump($first_movie,'$first_movie_sdasdas');
   myvar_dump($second_movie,'$second_movie_sfasfa');
   myvar_dump($second_m_json,'$second_m_json_sfasfa');
   ?>
<div id="main_frame">
    <h1 class="header">Arena test task</h1>
    <form id="input_form">

    </form>
    <div id="msg_area"></div>
</div>

</body>
</html>