<!-- WISH LIST BANNER DETAILS -->
<section class="home_wish_list_banner">
    <img class="img-fluid" alt="wish_list_banner"
         src="<?php echo base_url("assets/images/sub_banner_wish_list.png"); ?>">
</section>


<div id="wishListItemList" class="container mb-5">

    <!-- MY WISH LIST ITEMS HOME-->
    <section class="bright py-2 text-center mt-2 pt-3 mb-4">
        <div class="container mx-auto">
            <div id="wishListItemsList" class="row mt-3">
                <script type="text/template" id="wishListItemTemplate">

                    <div class="container" style="margin-bottom: 20px">
                        <div class="row">
                            <div class="col-sm">
                                <button id="wishListItemSortByIdBtn" type="submit" class="btn btn-dark">Sort By ID <i
                                            class="fa fa-fw fa-sort"></i></button>
                            </div>
                            <div class="col-sm">
                                <button id="wishListItemSortByProyorityBtn" type="submit" class="btn btn-dark">Sort By
                                    PRIORITY <i
                                            class="fa fa-fw fa-sort"></i></button>
                            </div>

                        </div>
                    </div>


                    <% _.each(wishListItem, function(wishListItem) { %>

                    <div id="wishListItemAction" class="card mr-4 mb-4 wishListItem" role="button">
                        <img class="card-img-top"
                             src='<%=wishListItem.imageUrl%>'
                             alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><%=wishListItem.title%></h5>
                            <p class="card-text"><%=wishListItem.description%></p>
                            <hr>
                            <span style="margin-right: 10px; font-weight: 600"></span>
                            <%=wishListItem.websiteTitle%>
                            <br>
                            <span style="margin-right: 10px; font-weight: 600">Website:</span> <a
                                    href="<%=wishListItem.websiteUrl%>">CLICK HERE</a>
                            <br>
                            <span style="margin-right: 10px; font-weight: 600">Price:</span> Rs
                            <%=wishListItem.price%>
                            <br>
                            <span style="margin-right: 10px; font-weight: 600;">Quantity:</span>
                            <%=wishListItem.quantity%>
                            <br>
                            <span style="margin-right: 10px; font-weight: 600;">Priority:</span>
                            <%=wishListItem.priority%>
                        </div>
                    </div>
                    <%});%>
                </script>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var WishListItem = Backbone.Model.extend({
            urlRoot: function () {
                return "<?php echo base_url() ?>index.php/api/myWishListV1/wishListItem"
                    + this.get("word");
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

        var WishListItemCollection = Backbone.Collection.extend({
            model: WishListItem,
            prefix: "",
            url: function () {
                return "<?php echo base_url() ?>index.php/api/myWishListV1/wishListItemsAllPublic/userId/<?php echo $_GET['userId']; ?>";
            },
        });

        // create collections of Wish list item object
        var wishListItems = new WishListItemCollection();

        var WishListItemsView = Backbone.View.extend(
            {
                el: '#wishListItemsList',
                template: _.template($("#wishListItemTemplate").html()),
                model: wishListItems,
                initialize: function () {
                    console.log('Initializing Wish List Items View');
                    this.model = new WishListItemCollection();
                    // this.listenTo(this.model, "sync", this.render);
                    this.listenTo(this.model, 'sync add remove change sort', this.render);
                    this.model.fetch();
                    console.log(this.model);
                },
                onSync: function () {
                    this.render();
                    //other logic
                },
                render: function () {
                    // the persons will be "visible" in your template
                    console.log(this.model.toJSON());
                    this.$el.html(this.template({wishListItem: this.model.toJSON()}));
                    return this;
                },
                events: {
                    "click #wishListItemAction": 'wishListItemAction',
                    'click #wishListItemSortByProyorityBtn': 'wishListItemSortByProyority',
                    'click #wishListItemSortByIdBtn': 'wishListItemSortById',
                },
                // delete item
                wishListItemAction: function () {
                    console.log('Start Delete...');
                    //location.href = "<?php //echo base_url() ?>//index.php/WishListHome";
                },
                wishListItemSortById: function () {
                    console.log('Start Sort By Id...');
                    this.model.comparator = 'id';
                    this.model.sort();
                    WishListItemsView.addAll();
                },
                wishListItemSortByProyority: function () {
                    console.log('Start Sort By Priority...');
                    this.model.comparator = 'priority';
                    this.model.sort();
                    WishListItemsView.addAll();
                }
                // initialize: function () {
                //     console.log('Initializing Wish List Items View');
                //     this.model.on('sync', this.render, this)
                // },
                // render: function () {
                //     // display content
                //     $('#wishListItemList').empty(); // remove previous words
                //     var self = this;
                //     this.model.each(function (c) {
                //         console.log(c);
                //         // var cimg = "<div>" + c.get('word') + "</div>"
                //         self.$el.append(self.template(c.attributes))
                //     })
                // },
            }
        )

        var wishListItemsView = new WishListItemsView();

    });

    addNewWish = function () {
        location.href = "<?php echo base_url() ?>index.php/AddNewWish";
    }

    function getPriority(val) {
        switch (priority) {
            case "1":
                return 'A'
            case "2":
                return 'B'
            case "3":
                return 'C'
        }
    }


</script>