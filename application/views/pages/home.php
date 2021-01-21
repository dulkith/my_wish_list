<?php
require APPPATH . '/libraries/PHPMailer-6.2.0/src/PHPMailer.php';
require APPPATH . '/libraries/PHPMailer-6.2.0/src/SMTP.php';

//if(isset($_POST['button1'])) {
//    echo "This is Button1 that is selected";
//}

if (isset($_POST['email'])) {

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP(); // enable SMTP

    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "chamaradasun1234@gmail.com";
    $mail->Password = "0772088783";
    $mail->SetFrom("xxxxxx@xxxxx.com");
    $mail->Subject = "MyWishList.lk";
    $mail->Body = "<h1>MY_WISH_LIST.LK</h1><img src='https://i.ibb.co/wB6rjpN/wish-list-logo-main.png' width='50' height='50' alt='' /><br>
            Click this link to view wish list >>>>" . base_url() . "index.php/PublicLink?userId=1";
    $mail->AddAddress($_POST['email']);
    $mail->Send();
}

?>

<!-- WISH LIST BANNER DETAILS -->
<section class="home_wish_list_banner">
    <img class="img-fluid" alt="wish_list_banner"
         src="<?php echo base_url("assets/images/sub_banner_wish_list.png"); ?>">
</section>

<div id="wishListItemList" class="container mb-5">
    <div class="col-md-12 text-center mt-2 pt-3 mb-4">
        <button onclick="addNewWish()" type="button" class="btn btn-outline-danger w-50 p-4"><i
                    class="fas fa-plus fa-2x"></i> <span
                    class="add_new_wish_btn">&nbsp;NEW WISH</span></button>
    </div>

    <!-- MY WISH LIST ITEMS HOME-->
    <section class="bright py-2 text-center mt-2 pt-3 mb-4">
        <div class="container mx-auto">
            <div id="wishListItemsList" class="row mt-3">
                <script type="text/template" id="wishListItemTemplate">

                    <!-- Email Modal -->
                    <div class="modal fade" style="width:1250px;" id="emailModalCenter" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLongTitle">Wish list Share by Email</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post" id="formx">
                                    <div class="modal-body">
                                        Are you sure you want to share this wish list with public?
                                        <br><br>
                                        <b>Link:</b><br>
                                        <a href="<?php echo base_url() ?>index.php/PublicLink?userId=1"><?php echo base_url() ?>index.php/PublicLink?userId=1</a>
                                    </div>
                                    <div class="mx-4 mt-3 row">
                                        <div class="col-12">
                                            <label class="wish-list-form-label">Email Address</label><br><br>
                                        </div>
                                        <div class="col-12">
                                            <textarea id="email" name="email" class="form-control"
                                                      placeholder="Enter aemail address" rows="3"></textarea>
                                            <span class="mt-3 error-messages"><?php echo form_error('itemTitle'); ?></span>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE
                                        </button>
                                        <input class="btn btn-danger" type="submit" name="submit" value="Share">
                                        <!--                                        <button name="sendEmail" type="button" class="btn btn-danger">SHARE</button>-->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

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
                            <div class="col-sm">
                                <button id="wishListItemSortByIdBtn" type="submit" class="btn btn-dark"
                                        data-toggle="modal" data-target="#emailModalCenter"><i
                                            class="far fa-envelope"></i> SHARE BY EMAIL
                                </button>
                            </div>
                        </div>
                    </div>

                    <% _.each(wishListItem, function(wishListItem) { %>

                    <a href="<?php echo base_url() ?>index.php/Edit?id=<%=wishListItem.id%>">
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
                    </a>
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
                console.log("<?php echo base_url() ?>index.php/api/myWishListV1/wishListItemsAll/userId/" + globalUserDetails.userid)
                return "<?php echo base_url() ?>index.php/api/myWishListV1/wishListItemsAll/userId/" + globalUserDetails.userid;
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
                    location.href = "<?php echo base_url() ?>index.php/WishListHome";
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