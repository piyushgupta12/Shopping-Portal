<script src="js/ZeroClipboard.js"></script>

<script>
$(document).ready(function()
{
    
                var clientTarget = new ZeroClipboard( $("#target-to-copy"), {
              moviePath: "js/ZeroClipboard.swf",
              debug: false
            } );

            clientTarget.on( "load", function(clientTarget)
            {
                $('#flash-loaded').fadeIn();

                clientTarget.on( "complete", function(clientTarget, args) {
                    clientTarget.setText( args.text );
                    $('#target-to-copy-text').fadeIn();
                } );
            } );
        
    });
</script>    
<p>
        <button id="target-to-copy" data-clipboard-target="clipboard-text">Click To Copy</button><br/>
        <textarea name="clipboard-text" id="clipboard-text" cols="30" rows="10">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus mattis lacus nibh, ac sollicitudin sapien accumsan in. Mauris euismod posuere tellus luctus sodales.
            Fusce a consectetur massa, non tincidunt mauris. Phasellus a rutrum libero. Praesent tempus urna et nisi aliquam convallis. Fusce porttitor justo condimentum orci euismod, pulvinar congue magna vestibulum.
            Sed gravida eleifend justo, id ultrices tellus porttitor nec. Nam porttitor gravida tempor. In libero ante, euismod ac fermentum nec, gravida ut dolor. Nullam a pulvinar ligula.
            Phasellus euismod rutrum risus non dapibus. Nullam pretium mauris vel fringilla pretium. Mauris faucibus risus vitae nulla dignissim imperdiet.
            Pellentesque elementum venenatis arcu, ut bibendum risus varius nec. Fusce eu tincidunt nunc. Duis sagittis dolor congue mauris tincidunt, eu condimentum eros rhoncus.
        </textarea>
    </p>