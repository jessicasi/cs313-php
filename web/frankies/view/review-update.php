<?php include '../common/header.php'?>

<h1><?php if(isset($_SESSION['reviewInfo']['type_name'])){echo $_SESSION['reviewInfo']['type_name'];}?>    
 Review</h1>
<?php
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
}
?>
<div class="review-info">
<p> Reviewed On <?php if(isset($_SESSION['reviewInfo']['review_date'])){echo $_SESSION['reviewInfo']['review_date'];}?></p>
<hr>
<form method="post" action="/frankies/reviews/index.php" class="accountForms">
<div class="form-group explain">
<label for="review_text">Review Text</label>
<textarea  class="form-control" name="review_text" id="review_text" required><?php if(isset($_SESSION['reviewInfo']['review_text'])){echo $_SESSION['reviewInfo']['review_text'];}?></textarea>
</div>
<div class="form-group explain">
<input type="hidden" name="action" value="updateReview">
<input type="hidden" name="review_id" value='<?php echo $review_id;?>'>
<input type="submit" name="submit" value="Update Review" title="Modify Review">
</div>
</form>

</div>
<?php include '../common/footer.php'?>