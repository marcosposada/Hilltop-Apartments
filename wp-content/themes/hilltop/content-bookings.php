<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="entry-header">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </div><!-- .entry-header -->

    <div class="entry-content">
        <div id="bookGrid">&nbsp;</div>
        <link rel="stylesheet" href="https://gadgets.securetravelpayments.com/_shared/css/all.cssz" type="text/css" />
        <script src="https://gadgets.securetravelpayments.com/_shared/base.jsz" type="text/javascript"></script>
        <script src="https://gadgets.securetravelpayments.com/room-types/room-types.jsz" type="text/javascript"></script>
        <script type="text/javascript">
            $w('#bookGrid').roomTypesGadget({
                hotelID: 338529
                //,specificRatePlan: [40290980]
                ,autoTickedNights: false
                ,defaultAdults: 2
                ,defaultChildren: 0
                ,defaultCurrency: 'AUD'
                ,defaultDate:''
                ,showPromotionCode:true
                ,defaultPromotionCode:''
                ,defaultDaysOut: 0
                ,defaultGridColumns: 10
                ,gridLabel: 'Room Types'
                ,returnUrl: null
                ,maxAdults: 20
                ,maxChildren: 0
                ,maxImages: 10
                ,promoteSpecials:true
                ,layout: 'horz'
                ,ratePlanFilter:true
                ,showMaxGuests:false
                ,showRoomImages:true
                ,maxRooms: 4
            });
        </script>
    </div><!-- .entry-content -->

</article><!-- #post-## -->
