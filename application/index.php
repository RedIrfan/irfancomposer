<?php

    require_once "./../vendor/autoload.php";
    session_start();
    
    use Dompdf\Dompdf;

    $html = "
    <table>
        <thead>
            <th>Name</th>
            <th>Email</th>
        </thead>
        <tbody>
        ";

    if (isset($_SESSION["faker_datas"]) and isset($_POST["submit"])){
        $faker_datas = $_SESSION["faker_datas"];
        foreach ($faker_datas as $data){
            $html .= "<tr>";
            $html .= "<td>" . $data[0] . "</td>";
            $html .= "<td>" . $data[1] . "</td>";
            $html .= "</tr>";
        }
    } else{
        $faker = Faker\Factory::create();
        $faker_datas = array();

        for ($i=0;$i<5;$i++){
            $name = $faker->name();
            $email = $faker->email();
            array_push($faker_datas, array($name, $email));

            $html .= "<tr>";
            $html .= "<td>" . $name . "</td>";
            $html .= "<td>" . $email . "</td>";
            $html .= "</tr>";
        }

        $_SESSION["faker_datas"] = $faker_datas;
    }

    if (isset($_POST["submit"])){
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
    
        $dompdf->setPaper('A4', 'landscape');
    
        $dompdf->render();
    
        $dompdf->stream();
    }
    else{
        echo "
        <form action=''  method='post'>
            <button name='submit'>Print</button>
        </form>
        ";
        echo $html;
    }

?>
