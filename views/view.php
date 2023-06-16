<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/css/style.css">
    <title>Word to Number generator and vice versa 🔄</title>
</head>
<body>

    <form method='POST' action='index.php?action=<?php echo $this->default;?>'>
        <h1><?php echo $formTitle;?></h1>
        <input name='input1' placeholder="<?php echo $firstInputFieldPlaceholder;?>" type="<?php echo $firstInputFieldType;?>" required/>
        <h2 class='errMessage'><?php echo $this->errMessage;?></h2>
        <input placeholder="<?php echo $secondInputFieldPlaceholder;?>" type="<?php echo $secondInputFieldType;?>" value='<?php echo $value?>' disabled/>
        <button class="btn" type='submit'>Convert</button>
        <a href="index.php?action=change&function=<?php echo $this->default?>"><?php echo $change;?></a>
        
        <h3><img src="https://twemoji.maxcdn.com/2/svg/1f1f5-1f1ed.svg" alt="phFlag" srcset="" width='20rem' height = '20rem'> PHP 
        <?php if(isset($total)){echo $total;}?> = <img src="https://twemoji.maxcdn.com/2/svg/1f1fa-1f1f8.svg" alt="phFlag" srcset="" width='20rem' height = '20rem'> USD 
            <?php if(isset($numberInUSD)){echo $numberInUSD;}?></h3>
    </form>

</body>
</html>