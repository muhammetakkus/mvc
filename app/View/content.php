<?php include 'layout/layout.php'; ?>

@section(css)
  <style media="screen">
    input {
      border: 1px solid #ccc;
      border-radius: 3px;
      padding: 10px;
    }
    hr {
      margin: 20px 0;
    }
  </style>
@stop

@section(content)
    <h4>content page</h4>

    <hr>

    <?php
        foreach($colors as $value)
        {
          echo $value . "-";
        }

        echo "<hr>";

        foreach($id as $key => $value)
        {
          echo $key . " = " . $value . "</br>";
        }
    ?>

    <hr>

    <form action="<?php echo URL; ?>test-post" method="post">
        <input type="text" name="name" placeholder="input the name..">
        <button type="submit">POST</button>
    </form>
@stop

@section(script)
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    $.ajax({
        'url': 'http://localhost:70/test-post',
        'data': 'name=ajaxxx',
        'type': 'POST'
    });
</script>
@stop
