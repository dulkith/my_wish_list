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
        <h1>Edit Wish List Item</h1>
    </div>

    <div id="wishListItem"></div>
    <script type="text/template" id="wishListItemtemplate">

        <div class="mx-4 mt-3 row">
            <div class="col-12">
                <label class="wish-list-form-label">Item Title</label>
            </div>
            <div class="col-12">
                <input id="itemTitle" name="itemTitle" class="wish-list-form-input"
                       value="<%=wishListItem.title%>"
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
                          placeholder="Enter wish list item description"
                          rows="3"><%=wishListItem.description%></textarea>
                <span class="mt-3 error-messages"><?php echo form_error('itemTitle'); ?></span>
            </div>
        </div>

        <div class="mx-4 mt-3 row">
            <div class="col-12">
                <label class="wish-list-form-label">Website Details</label>
            </div>
            <div class="col-sm-6 col-12 ">
                <input id="webSiteTitle" name="webSiteTitle"
                       class="wish-list-form-input" value="<%=wishListItem.websiteTitle%>">
                <span class="error-messages mt-3"><?php echo form_error('webSiteTitle'); ?></span>
            </div>
            <div class="col-sm-6 mt-2 mt-sm-0 col-12  ">
                <input id="webSiteUrl" name="webSiteUrl" class="wish-list-form-input"
                       value="<%=wishListItem.websiteUrl%>">
                <span class="error-messages"><?php echo form_error('webSiteUrl'); ?></span>
            </div>
        </div>

        <div class="mx-4 mt-3 row">
            <div class="col-12">
                <label class="wish-list-form-label">Image URL</label>
            </div>
            <div class="col-12">
                <input id="itemImageUrl" name="itemImageUrl" class="wish-list-form-input"
                       value="<%=wishListItem.imageUrl%>"
                       type="text">
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
                    <input id="price" type="text" class="form-control" value="<%=wishListItem.price%>">
                </div>
                <span class="error-messages mt-3"><?php echo form_error('price'); ?></span>
            </div>
            <div class="col-sm-6 mt-2 mt-sm-0 col-12  ">
                <input id="quantity" type="number" class="form-control" name="quantity" min="1"
                       value="<%=wishListItem.quantity%>">
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
                <%= globalUserDetails.selectProyority(wishListItem.priority)%>
                <span class="mt-3 error-messages"><?php echo form_error('itemPriority'); ?></span>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="col-12 mt-5 mb-5 d-flex justify-content-center">
                        <button id="oldWishListItemSubmitBtn" type="submit"
                                class="btn btn-success btn-lg checkout-btn">
                            <i class="fas fa-edit"></i> UPDATE ITEM
                        </button>
                    </div>
                </div>
                <div class="col">

                    <div class="col-12 mt-5 mb-5 d-flex justify-content-center">
                        <button id="deleteNewWishListItemBtn" type="submit"
                                class="btn btn-danger btn-lg checkout-btn">
                            <i class="far fa-trash-alt"></i> DELETE ITEM
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </script>
</div>


<script language="javascript">
    $(document).ready(function () {
        var OldWishListItem = Backbone.Model.extend({
            urlRoot: function () {
                return "<?php echo base_url() ?>index.php/api/myWishListV1/wishListItem/id/<?php echo $_GET['id']; ?>";
            },
            idAttribute: "id",
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
            // tagName: 'li',
            el: '#wishListItem',
            template: _.template($('#wishListItemtemplate').html()),
            model: OldWishListItem,
            initialize: function () {
                console.log('Initializing New Wish List Item View');
                this.model = new OldWishListItem();
                this.model.fetch({async: false})
                this.render();
                this.listenTo(this.model, 'add remove change sort', this.render);
            },
            render: function () {
                console.log(this.model.toJSON());
                // $(this.el).html(this.template(this.model.toJSON()));

                this.$el.html(this.template({wishListItem: this.model.toJSON()}));

                // this.$el.html(this.template(this.model.toJSON()));
                this.editForm = this.$('#editForm');
                $('#itemPriority').click(function () {
                    $('select[name=selValue]').val(1);
                });
                return this;
            },
            events: {
                "click #oldWishListItemSubmitBtn": 'updateNewWishListItem',
                "click #deleteNewWishListItemBtn": 'deleteNewWishListItem',
            },
            deleteNewWishListItem: function () {
                console.log('Start delete wish list item...');
                this.model.destroy(
                    {
                        url: "<?php echo base_url() ?>index.php/api/myWishListV1/wishListItem/id/<?php echo $_GET['id']; ?>",
                        success: async function () {
                            Swal.fire({
                                icon: 'success',
                                title: 'Delete wish-list item Successfully!',
                                showConfirmButton: false,
                                timer: 2000
                            })
                            await sleep(2000);
                            location.href = "<?php echo base_url() ?>index.php/wishListHome/index";
                        },
                        error: function (errorResponse) {
                            console.log(errorResponse)
                        }
                    });
            },
            updateNewWishListItem: function () {
                console.log('Start update wish list item...');
                // create the model here
                var id = <?php echo $_GET['id']; ?>;
                var itemTitle = $('#itemTitle').val();
                var webSiteTitle = $('#webSiteTitle').val();
                var itemDescription = $('#itemDescription').val();
                var webSiteUrl = $('#webSiteUrl').val();
                var itemImageUrl = $('#itemImageUrl').val();
                var price = $('#price').val();
                var quantity = $('#quantity').val();
                var itemPriority = $('#itemPriority').val();
                var userId = globalUserDetails.userid;

                var newWishListItemModel = new OldWishListItem();
                var newWishListItemData = {
                    'id': id,
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
                    success: async function (model, response, options) {
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
                        location.href = "<?php echo base_url() ?>index.php/wishListHome/index";
                    },
                    error: function (model, xhr, options) {
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

        globalUserDetails.selectProyority = function (val) {
            $("#itemPriority").val(val).change();
        }
        var newWishListItemView = new NewWishListItemView();
    });
</script>
