</div><!-- #content -->

<footer class="footer-main py-5">
    <div class="container">
        <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'twentytwentyfive-child' ) ); ?>">
            <?php
            printf( esc_html__( 'Proudly powered by %s', 'twentytwentyfive-child' ), 'WordPress' );
            ?>
        </a>
        <span class="sep"> | </span>
        <?php
        printf( esc_html__( 'Theme: %1$s by %2$s.', 'twentytwentyfive-child' ), 'fooz', '<a href="https://linkedin.com/in/michal-szkudlarek//">Michał Szkudlarek</a>' );
        ?>
    </div>
</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>