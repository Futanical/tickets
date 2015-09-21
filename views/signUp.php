<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up!</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-responsive.css">
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="container">
    <span class="span12">

        <form id="" method="post" action="" enctype="multipart/form-data" class="center-block">

            <?php if (isset($error)) { ?>
                <p class="warning"><?php echo $error; ?></p>
            <?php } ?>

            <?php if (isset($userRegistered)) { ?>
                <p class="warning"><?php echo $userRegistered; ?></p>
            <?php } ?>

            <!-- USERNAME -->

            <label for="username">Username</label>
            <?php if (isset($registerResult)) { ?>
                <p class="warning"><?php echo $registerResult; ?></p>
            <?php
            } elseif (isset($usernameResult)) {
                foreach ($usernameResult as $message) { ?>
                    <p class="warning"><?php echo $message; ?></p>
                <?php }
            } ?>
            <input type="text" name="username" id="username" value="<?php retainForm('username'); ?>">

            <!-- PASSWORD -->

            <label for="password">Password</label>
            <?php if (isset($passwordResult)) {
                foreach ($passwordResult as $message) { ?>
                    <p class="warning"><?php echo $message ?></p>
                <?php }
            } ?>
            <input type="password" name="password" id="password">

            <label for="confirmPassword">Confirm Password</label>
            <?php if (isset($passwordResult)) {
                foreach ($passwordResult as $message) { ?>
                    <p class="warning"><?php echo $message ?></p>
                <?php }
            } ?>
            <input type="password" name="confirmPassword" id="confirmPassword">

            <!-- FIRST NAME -->

            <label for="firstName">First Name</label>
            <?php errorHandle($missing, 'firstName', $missing, "Please enter your first name."); ?>
            <input type="text" name="firstName" id="firstName" value="<?php retainForm('firstName'); ?>">

            <!-- LAST NAME -->

            <label for="lastName">Last Name</label>
            <?php errorHandle($missing, 'lastName', $missing, "Please enter your last name."); ?>
            <input type="text" name="lastName" id="lastName" value="<?php retainForm('lastName'); ?>">

            <!-- EMAIL ADDRESS -->

            <label for="emailAddress">Email Address</label>
            <?php errorHandle($missing, 'emailAddress', $missing, "Please enter your email address."); ?>
            <?php if (isset($invalidEmail)) { ?>
                <p class="warning"><?php echo $invalidEmail; ?></p>
            <?php } ?>
            <input type="text" name="emailAddress" id="emailAddress" value="<?php retainForm('emailAddress'); ?>">

            <!-- ADDRESS -->

            <label for="address">Address</label>
            <?php errorHandle($missing, 'address', $missing, "Please enter your address.") ?>
            <input type="text" name="address" id="address" value="<?php retainForm('address'); ?>">

            <!-- CITY -->

            <label for="city">City</label>
            <?php errorHandle($missing, 'city', $missing, "Please enter your city.") ?>
            <input type="text" name="city" id="city" value="<?php retainForm('city'); ?>">

            <!-- STATE -->

            <label for="state">State</label>
            <?php errorHandle($missing, 'state', $missing, "Please enter your state.") ?>
            <select name="state" id="state">
                <option value="AL" <?php retainFormState('AL'); ?>>Alabama</option>
                <option value="AK" <?php retainFormState('AK'); ?>>Alaska</option>
                <option value="AZ" <?php retainFormState('AZ'); ?>>Arizona</option>
                <option value="AR" <?php retainFormState('AR'); ?>>Arkansas</option>
                <option value="CA" <?php retainFormState('CA'); ?>>California</option>
                <option value="CO" <?php retainFormState('CO'); ?>>Colorado</option>
                <option value="CT" <?php retainFormState('CT'); ?>>Connecticut</option>
                <option value="DE" <?php retainFormState('DE'); ?>>Delaware</option>
                <option value="DC" <?php retainFormState('DC'); ?>>District Of Columbia</option>
                <option value="FL" <?php retainFormState('FL'); ?>>Florida</option>
                <option value="GA" <?php retainFormState('GA'); ?>>Georgia</option>
                <option value="HI" <?php retainFormState('HI'); ?>>Hawaii</option>
                <option value="ID" <?php retainFormState('ID'); ?>>Idaho</option>
                <option value="IL" <?php retainFormState('IL'); ?>>Illinois</option>
                <option value="IN" <?php retainFormState('IN'); ?>>Indiana</option>
                <option value="IA" <?php retainFormState('IA'); ?>>Iowa</option>
                <option value="KS" <?php retainFormState('KS'); ?>>Kansas</option>
                <option value="KY" <?php retainFormState('KY'); ?>>Kentucky</option>
                <option value="LA" <?php retainFormState('LA'); ?>>Louisiana</option>
                <option value="ME" <?php retainFormState('ME'); ?>>Maine</option>
                <option value="MD" <?php retainFormState('MD'); ?>>Maryland</option>
                <option value="MA" <?php retainFormState('MA'); ?>>Massachusetts</option>
                <option value="MI" <?php retainFormState('MI'); ?>>Michigan</option>
                <option value="MN" <?php retainFormState('MN'); ?>>Minnesota</option>
                <option value="MS" <?php retainFormState('MS'); ?>>Mississippi</option>
                <option value="MO" <?php retainFormState('MO'); ?>>Missouri</option>
                <option value="MT" <?php retainFormState('MT'); ?>>Montana</option>
                <option value="NE" <?php retainFormState('NE'); ?>>Nebraska</option>
                <option value="NV" <?php retainFormState('NV'); ?>>Nevada</option>
                <option value="NH" <?php retainFormState('NH'); ?>>New Hampshire</option>
                <option value="NJ" <?php retainFormState('NJ'); ?>>New Jersey</option>
                <option value="NM" <?php retainFormState('NM'); ?>>New Mexico</option>
                <option value="NY" <?php retainFormState('NY'); ?>>New York</option>
                <option value="NC" <?php retainFormState('NC'); ?>>North Carolina</option>
                <option value="ND" <?php retainFormState('ND'); ?>>North Dakota</option>
                <option value="OH" <?php retainFormState('OH'); ?>>Ohio</option>
                <option value="OK" <?php retainFormState('OK'); ?>>Oklahoma</option>
                <option value="OR" <?php retainFormState('OR'); ?>>Oregon</option>
                <option value="PA" <?php retainFormState('PA'); ?>>Pennsylvania</option>
                <option value="RI" <?php retainFormState('RI'); ?>>Rhode Island</option>
                <option value="SC" <?php retainFormState('SC'); ?>>South Carolina</option>
                <option value="SD" <?php retainFormState('SD'); ?>>South Dakota</option>
                <option value="TN" <?php retainFormState('TN'); ?>>Tennessee</option>
                <option value="TX" <?php retainFormState('TX'); ?>>Texas</option>
                <option value="UT" <?php retainFormState('UT'); ?>>Utah</option>
                <option value="VT" <?php retainFormState('VT'); ?>>Vermont</option>
                <option value="VA" <?php retainFormState('VA'); ?>>Virginia</option>
                <option value="WA" <?php retainFormState('WA'); ?>>Washington</option>
                <option value="WV" <?php retainFormState('WV'); ?>>West Virginia</option>
                <option value="WI" <?php retainFormState('WI'); ?>>Wisconsin</option>
                <option value="WY" <?php retainFormState('WY'); ?>>Wyoming</option>
            </select>

            <!-- ZIP CODE -->

            <label for="zipCode">Zip Code</label>
            <?php errorHandle($missing, 'zipCode', $missing, "Please enter your zip code.") ?>
            <input type="text" name="zipCode" id="zipCode" value="<?php retainForm('zipCode'); ?>">

            <?php if (isset($imageUploadResult)) {
                foreach ($imageUploadResult as $message) { ?>
                    <p class="warning"><?php echo $message ?></p>
                <?php }
            } ?>

            <!-- IMAGE UPLOAD -->

            <input id="uploadFile" placeholder="Choose File" disabled="disabled">

            <div class="fileUpload btn btn-primary">
                <span>Upload</span>
                <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max; ?>">

                <input id="image" name="image" type="file" class="upload">
            </div>

            <script>
                document.getElementById("image").onchange = function () {
                    document.getElementById("uploadFile").value = this.value;
                };
            </script>

            <!-- SUBMIT -->

            <input type="submit" name="register" id="register" value="Register">

        </form>
    </span>
</div>
</body>
</html>