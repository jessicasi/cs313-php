<?php include 'common/header.php'; ?>
<?php session_start(); ?>

<div class="container">
    <h1>Checkout</h1>
    <hr>
    <?php if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
    };
    ?>

    <form action="test.php" method="post">
        <div class="row mb-3">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" placeholder="Name" id="name" name="name" class="form-control" required value= '<?php 
                if(isset($_SESSION["name"])){
                    echo $_SESSION["name"];
                    }?>'>
            </div>
        </div>
        <div class="row mb-3">
            <label for="address" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
                <input type="text" placeholder="Address" id="address" name="address" class="form-control" required value= '<?php 
                if(isset($_SESSION["address"])){
                    echo $_SESSION["address"];
                    }?>'>
            </div>
        </div>
        <div class="row mb-3">
            <label for="city" class="col-sm-2 col-form-label">City</label>
            <div class="col-sm-10">
                <input type="text" placeholder="City" id="city" name="city" class="form-control" required value= '<?php 
                if(isset($_SESSION["city"])){
                    echo $_SESSION["city"];
                    }?>'>
            </div>
        </div>
        <div class="row mb-3">
            <label for="state" class="col-sm-2 col-form-label">State</label>
            <div class="col-sm-10">
                <select name="state" id="state" class="form-select">
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="DC">District Of Columbia</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label for="zip" class="col-sm-2 col-form-label">Zip Code</label>
            <div class="col-sm-10">
                <input type="text" placeholder="Zip" id="zip" name="zip" class="form-control" required value= '<?php 
                if(isset($_SESSION["zip"])){
                    echo $_SESSION["zip"];
                    }?>'>
            </div>
        </div>
        <input type="hidden" name="action" value="checkout">
        <a href="/cs313-php/web/week3/cart?action=showCart" class="btn btn-primary col-sm-3" id="return">Return To Cart</a>
        <input name="submit" type="submit" value="Submit Order" class="btn btn-primary col-sm-3" id="order" required>
       
    </form>
</div>


<?php include 'common/footer.php'; ?>
<?php unset($_SESSION['message']); ?>