<?php
// https://jsonformatter.curiousconcept.com/#
//Resources: https://www.calculatorsoup.com/calculators/discretemathematics/factorials.php

if(isset($_GET['num1']) && isset($_GET['num2']) && isset($_GET['operation']))
{

    $num1 = strip_tags($_GET['num1']);
    $num2 = strip_tags($_GET['num2']);
    $operation = strip_tags($_GET['operation']);
    $result = NULL;
    $result2 = NULL;

    if($num1 == "" || $num2 == "")
    {
        $output = array(
            "ErrorCode" => "4",
            "Error Description" => "Missing parameters",
            "Value Expected" => "num1, num2 and operation"
        );
        echo json_encode($output);
    }
    else if($operation == "add")
    {
        $result = $num1 + $num2;
    }
    else if($operation == "substract")
    {
        $result = $num1 - $num2;
    }
    else if($operation == "multiply")
    {
        $result = $num1 * $num2;
    }
    else if($operation == "divide")
    {
        if($num2 == 0)
        {
            $output = array(
                "ErrorCode" => "3",
                "Error Description" => "Division by 0"
            );
            echo json_encode($output);
        }
        else
        {
            $result = $num1 / $num2;
        }
    }
    else if ($operation == "power") 
    {
        $result = pow($num1, $num2);
    }
    else if ($operation == "factorial") 
    {
        $numf1 = $num1;
        $numf2 = $num2;

        for ($nf = $numf1 - 1; $nf > 0; $nf--)   
            {  
                $numf1 = $numf1 * $nf;  
            } 
        for ($nf = $numf2 - 1; $nf > 0; $nf--)   
            {  
                $numf2 = $numf2 * $nf;  
            }

        $result = $numf1;
        $result2 = $numf2;
    }
    else if ($operation == "modulus") 
    {
        //$result = $num1 % $num2;
        $result = fmod($num1, $num2);
    }
    else{
        $output = array(
            "ErrorCode" => "1",
            "Error Description" => "Operation incorrect",
            "Value Expected" => "add, substract, multiply, divide, power or factorial",
            "Value Recieved" => "$operation"
        );
        echo json_encode($output);
    }
    if($operation == "factorial")
    {
        if(isset($result) && isset($result2))
        {
            $output = array(
                "FirstNumber" => $num1,
                "SecondNumber" => $num2,
                "Operation" => $operation,
                "Result first number" => $result,
                "Result second number" => $result2
            );
            echo json_encode($output);
        } 
    }
    else 
    {
        if(isset($result))
        {
            $output = array(
                "FirstNumber" => $num1,
                "SecondNumber" => $num2,
                "Operation" => $operation,
                "Result" => $result
            );
            echo json_encode($output);
        }       
    }

}
else
{
    $output = array(
        "ErrorCode" => "2",
        "Error Description" => "Missing parameters",
        "Parameters Required" => "num1, num2 and operation",
    );
    echo json_encode($output);
}
