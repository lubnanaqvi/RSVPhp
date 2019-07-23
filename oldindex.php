<!DOCTYPE html>
<html>
<head lang="en">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Tangerine" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Nobile" />
    <style>
        body
        {
            background-color: #282c38;
            text-align: center;
        }
        #emptydiv{
            height: 20px;
        }
        #hdiv{
            background: url('torbg.png') no-repeat;
            background-size: contain;
            font-family: "Tangerine";
            padding: 1%;
            margin: auto;
            color: #282c38;
            height: 316px;
            width:70%;
            font-size: xx-large;
        }
        #maindiv{
            background-color: white;
            padding: 2%;
            margin:auto;
            width:70%;
            color: #282c38;
            font-family: Nobile ;
        }
        #maindiv img{
            width: 100%;
        }
        #mybtn{
            background-color: #e79a4a;
            color: white;
            border-radius: 10%;
            margin: 2%;
            padding: 2%;
        }
        #fdiv{
            padding: 2%;
            margin: auto;
            background-color: white;
            font-family: Nobile;
            font-size: small;
            color:#282c38;
            width: 70%;
            text-align: left;
        }
        #clogo{
            vertical-align: top;
            padding: 2%;
        }
        .slogo{
            width: 100px;
            height: 100px;
            vertical-align: top;
            padding: 2%;
        }
    </style>
   
    <meta charset="UTF-8">
    <title>Annual Dinner- RSVP</title>
</head>
<body>
    <div id="emptydiv"></div>
    <div id="hdiv">
        <h1>Annual Dinner</h1>
    </div>
    <div id="maindiv">
        <img id="mevite" src="tormb.png">
        <br>
        <br>
        <form action="index.php" method="GET">
        <label>Your Email:</label>
        <input id='eeid' type='email' name='ee'>
        <br>
        <label>Are you attending?</label>
        <input type='radio' name='yn' value='Yes'>Yes
        <input type='radio' name='yn' value='No'>No
        <input type='submit' id='mybtn' value='Enter'>
        <br>
        <?php
        if(!empty($_GET)){
        $emailentered=$_GET['ee'];
        if(strlen($emailentered)==0)
            echo 'Please enter an email address.';
        else{
            $guestlistfile = 'guestlist.txt';
            //get current guest list
            $currentgl = file_get_contents($guestlistfile);
            //check if the user is in the guest list
            if(!strpos($currentgl,$emailentered))
                echo 'We are sorry, your email address is not in the Guest list';//user not found in guest list
            else
                if(isset($_GET['yn']))//user selected an option YES or NO to RSVP
                    {
                        $currentyesnolist=file_get_contents("yes.txt").file_get_contents("no.txt");//get all current responses
                        if(!strpos($currentyesnolist,$emailentered))//user has not replied already
                            {
                            echo strpos($currentyesnolist,$emailentered);
                            $yesno=strtolower($_GET['yn']).".txt"; //save user's response as $yesno and open the respective file
                            $newcontents=file_get_contents($yesno);
                            $newcontents.=$emailentered.PHP_EOL;
                            file_put_contents($yesno, $newcontents);
                            echo 'Thank you for entering your response. Your response has been saved.';
                            }
                        else
                            echo 'We have already recieved your response.';
                    }
                else
                {
                    echo 'Please select Yes or No.';
                }
            //$currentyl .= $emailentered.PHP_EOL;
            //file_put_contents($file, $current);
            }
        }
        ?>
        </form>
    </div>
</body>
</html>