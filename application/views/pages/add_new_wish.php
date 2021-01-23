<!-- Redirect user to home when try to load login page from url -->
<script language="javascript">
if (!globalUserDetails.userid) {
    location.href = "<?php echo base_url() ?>index.php/Login";
}
</script>

<!-- WISH LIST BANNER DETAILS -->
<section class="home_wish_list_banner">
    <img class="img-fluid" alt="wish_list_banner"
        src="<?php echo base_url("assets/images/sub_banner_wish_list.png"); ?>">
</section>

<div id="testContainer" class="container mb-5">
    <div class="col-md-12 mt-2 pt-3 mb-4">
        <h1>Add New Wish Item</h1>
    </div>

    <div class="mx-4 mt-3 row">
        <div class="col-12">
            <label class="wish-list-form-label">Item Title</label>
        </div>
        <div class="col-12">
            <input id="itemTitle" name="itemTitle" class="wish-list-form-input" placeholder="Enter wish list item title"
                type="text">
            <span class="mt-3 error-messages"><?php echo form_error('itemTitle'); ?></span>
        </div>
    </div>

    <div class="mx-4 mt-3 row">
        <div class="col-12">
            <label class="wish-list-form-label">Item Description</label>
        </div>
        <div class="col-12">
            <textarea id="itemDescription" name="itemDescription" class="form-control"
                placeholder="Enter wish list item description" rows="3"></textarea>
            <span class="mt-3 error-messages"><?php echo form_error('itemTitle'); ?></span>
        </div>
    </div>

    <div class="mx-4 mt-3 row">
        <div class="col-12">
            <label class="wish-list-form-label">Website Details</label>
        </div>
        <div class="col-sm-6 col-12 ">
            <input id="webSiteTitle" name="webSiteTitle" class="wish-list-form-input" placeholder="Web Site Title">
            <span class="error-messages mt-3"><?php echo form_error('webSiteTitle'); ?></span>
        </div>
        <div class="col-sm-6 mt-2 mt-sm-0 col-12  ">
            <input id="webSiteUrl" name="webSiteUrl" class="wish-list-form-input" placeholder="Web Site URL">
            <span class="error-messages"><?php echo form_error('webSiteUrl'); ?></span>
        </div>
    </div>

    <div class="mx-4 mt-3 row">
        <div class="col-12">
            <label class="wish-list-form-label">Image URL</label>
        </div>
        <div class="col-12">
            <input id="itemImageUrl" name="itemImageUrl" class="wish-list-form-input"
                placeholder="Enter valid image URL" type="text">
            <span class="mt-3 error-messages"><?php echo form_error('itemImageUrl'); ?></span>
        </div>
    </div>

    <div class="mx-4 mt-3 row">
        <div class="col-12">
            <label class="wish-list-form-label">Other Details</label>
        </div>
        <div class="col-sm-6 col-12 ">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Rs</span>
                </div>
                <input id="price" type="text" class="form-control" placeholder="Enter price of item">
            </div>
            <span class="error-messages mt-3"><?php echo form_error('price'); ?></span>
        </div>
        <div class="col-sm-6 mt-2 mt-sm-0 col-12  ">
            <input id="quantity" type="number" class="form-control" name="quantity" min="1"
                placeholder="Enter number of item/s">
            <span class="error-messages"><?php echo form_error('quantity'); ?></span>
        </div>
    </div>

    <div class="mx-4 row">
        <div class="col-12">
            <label class="wish-list-form-label">Item Priority</label>
        </div>
        <div class="col-12">
            <select id="itemPriority" name="itemPriority" class="form-control" required>
                <option disabled hidden selected>Select</option>
                <option value="1">Must Have</option>
                <option value="2">Nice to Have</option>
                <option value="3">If I can</option>
            </select>
            <span class="mt-3 error-messages"><?php echo form_error('itemPriority'); ?></span>
        </div>
    </div>

    <div class="col-12 mt-5 mb-5 d-flex justify-content-center">
        <button id="newWishListItemSubmitBtn" type="submit" class="btn btn-outline-danger btn-lg checkout-btn">
            SAVE WISH LIST ITEM
        </button>
    </div>

</div>

<script language="javascript">
var NewWishListItem = Backbone.Model.extend({
    urlRoot: function() {
        return "<?php echo base_url() ?>index.php/api/myWishListV1/wishListItem";
    },
    idAttribute: "",
    defaults: {
        id: "",
        title: "",
        description: "",
        imageUrl: "",
        websiteUrl: "",
        websiteTitle: "",
        price: 0.00,
        quantity: 0,
        priority: 3,
        userId: "",
        created: "",
    },
});

var NewWishListItemView = Backbone.View.extend({
    el: "#testContainer",
    initialize: function() {
        console.log('Initializing New Wish List Item View');
    },
    render: function() {
        return this;
    },
    events: {
        "click #newWishListItemSubmitBtn": 'saveNewWishListItem',
    },
    saveNewWishListItem: function() {
        console.log('Start add new wish list item...');
        // create the model here
        var itemTitle = $('#itemTitle').val();
        var webSiteTitle = $('#webSiteTitle').val();
        var itemDescription = $('#itemDescription').val();
        var webSiteUrl = $('#webSiteUrl').val();
        var itemImageUrl = $('#itemImageUrl').val();
        var price = $('#price').val();
        var quantity = $('#quantity').val();
        var itemPriority = $('#itemPriority').val();
        var userId = globalUserDetails.userid;

        var newWishListItemModel = new NewWishListItem();
        var newWishListItemData = {
            'itemTitle': itemTitle,
            'webSiteTitle': webSiteTitle,
            'itemDescription': itemDescription,
            'webSiteUrl': webSiteUrl,
            'itemImageUrl': itemImageUrl,
            'price': price,
            'quantity': quantity,
            'itemPriority': itemPriority,
            'userId': userId,
        }
        console.log(newWishListItemData);

        newWishListItemModel.save(newWishListItemData, {
            async: false,
            success: async function(model, response, options) {
                // login successful message display
                Swal.fire({
                    icon: 'success',
                    title: 'Add new wish-list item Successfully!',
                    showConfirmButton: false,
                    timer: 2000
                })
                console.log(response);
                console.log(model);
                console.log(options);
                // redirect to home page
                await sleep(2000);
                window.history.pushState('object or string', 'Title', '/new-url');
                // location.href = "<?php echo base_url() ?>index.php/wishListHome/index";
            },
            error: function(model, xhr, options) {
                console.log(xhr);
                // login error message display
                Swal.fire({
                    icon: 'error',
                    title: xhr.responseJSON,
                    text: 'Please try again!',
                    timer: 4000,
                    timerProgressBar: true,
                    footer: '<a href>Why do I have this issue?</a>'
                })
            }
        });
    }
});

var newWishListItemView = new NewWishListItemView();
</script>