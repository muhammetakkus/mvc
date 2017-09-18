<?php include "/layout.php"; ?>

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

    <?php echo $nn; ?>

    <!-- Eğer POST işleminde CSRF oluşturulmak isteniyorsa hidden bir inputun value değerine aşağıdaki gibi token oluşturulur. -->
    <!-- use MVC\App\Core\Helper\Token; sabit olarak nerede çağrılabilir ?? -->
    <form action="<?php echo URL;?>name" method="post">
        <input type="text" name="name" placeholder="input the name..">
        <button type="submit">GÖNDER</button>
        <!-- Her Post İşleminde hidden inputta token bu şekilde oluşturulmalı -->
        <input type="hidden" name="_token" value="<?php App\Core\Src\Token::create(); ?>">
    </form>
@stop

@section(script)
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
    /* CSRF Test - token gönderilmezse CSRF hatasına verir */
    $.ajax({
        'url': 'http://localhost/MVC/name',
        'data': 'name=ajax post isteği girişi&_token=<?php echo $_SESSION['_token']; ?>',
        'type': 'POST'
    });
</script>
@stop
