window.WishListItem = Backbone.Model.extend({
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

window.WishListItemCollection = Backbone.Collection.extend({
    model: WishListItem,
    prefix: "",
    url: function () {
        return "<?php echo base_url() ?>index.php/api/myWishListV1/wishListItemsAll/userId/" + globalUserDetails.userid;
    },
});