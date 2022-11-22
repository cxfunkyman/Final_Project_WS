<?php
// 
//Resources: https://www.calculatorsoup.com/calculators/discretemathematics/factorials.php
$dom = new DOMDocument('1.0','UTF-8');
$dom->formatOutput = true; //This property would format the XML output
$root = $dom->createElement('output');
$dom->appendChild($root);
// Appending the above created $root to the object creates the following: <student></student>

//Adding the course to the root (student)
$info = $dom->createElement('info');
$root->appendChild($info);
// Appending the above created $course to the object creates the following: <student><course></course></student>
// Setting the attribute course='1'
$info->setAttribute('info', 'description');

if(isset($_GET['num1']) && isset($_GET['num2']) && isset($_GET['operation']))
{
    $num1 = strip_tags($_GET['num1']);
    $num2 = strip_tags($_GET['num2']);
    $operation = strip_tags($_GET['operation']);
    $result = NULL;
    $result2 = NULL;

    if($num1 == "" || $num2 == "")
    {
        $errorCode = $dom->createElement('errorCode', 'Error code 4, ');
        $errorDescription = $dom->createElement('errorDescription', 'Description - Missing parameters num1, num2 and operation');
        $info->appendChild($errorCode);
        $info->appendChild($errorDescription);
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
        //Adding details to the web services course
            $errorCode = $dom->createElement('errorCode', 'Error code 3, ');
            $errorDescription = $dom->createElement('errorDescription', 'Description - Division by 0 not accepted');
           
            $info->appendChild($errorCode);
            $info->appendChild($errorDescription);
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
 
    //Adding details to the web services course
        $errorCode = $dom->createElement('errorCode', 'Error code 1, ');
        $errorDescription = $dom->createElement('errorDescription', 'Description - Operation incorrect, ');
        $parametersRequired = $dom->createElement('parametersRequired', 'Expected operation add, substract, multiply, divide, power or factorial, ');
        $errorValue = $dom->createElement('errorValue', "Value Recieved $operation");
        
        $info->appendChild($errorCode);
        $info->appendChild($errorDescription);
        $info->appendChild($parametersRequired);
        $info->appendChild($errorValue);
    }
    if($operation == "factorial")
    {
        if(isset($result) && isset($result2))
        {          
            //Adding details to the web services course
            $firstNumber = $dom->createElement('firstNumber', "First number $num1, ");
            $secondNumber = $dom->createElement('secondNumber', "Second number $num2, ");
            $operation = $dom->createElement('operation', "Operation $operation, ");
            $resultFNumber = $dom->createElement('resultFNumber', "Result first number $result, ");
            $resultSNumber = $dom->createElement('resultSNumber', "Result second number $result2");

            $info->appendChild($firstNumber );
            $info->appendChild($secondNumber);
            $info->appendChild($operation);
            $info->appendChild($resultFNumber);
            $info->appendChild($resultSNumber);     

        } 
    }
    else 
    {
        if(isset($result))
        {         
            //Adding details to the web services course
            $firstNumber = $dom->createElement('firstNumber', "First number $num1, ");
            $secondNumber = $dom->createElement('secondNumber', "Second number $num2, ");
            $operation = $dom->createElement('operation', "Operation $operation, ");
            $resultNumber = $dom->createElement('resultNumber', "Result number $result");
           
            $info->appendChild($firstNumber );
            $info->appendChild($secondNumber);
            $info->appendChild($operation);
            $info->appendChild($resultNumber);

        }       
    }

}
else
{  
    //Adding details to the web services course
    $errorCode = $dom->createElement('errorCode', 'Error code 2, ');
    $errorDescription = $dom->createElement('errorDescription', 'Description - Missing parameters, ');
    $parametersRequired = $dom->createElement('parametersRequired', 'Parameters Required - num1, num2 and operation');
    
    $info->appendChild($errorCode);
    $info->appendChild($errorDescription);
    $info->appendChild($parametersRequired);
}
echo $dom->saveXML();
