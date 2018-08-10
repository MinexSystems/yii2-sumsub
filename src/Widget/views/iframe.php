<?php
/**
 * Created by PhpStorm.
 * User: miroslav
 * Date: 01.08.18
 * Time: 15:42
 */

use Minexsystems\SumSub\Assets\SumSubAssets;

SumSubAssets::register($this)
?>
<div id="idensic"></div>

<script>
    idensic.init(
        '#idensic',
        {
            accessToken: "<?=$accessToken; ?>",
            requiredDocuments: "IDENTITY:PASSPORT,ID_CARD;SELFIE:SELFIE;PROOF_OF_RESIDENCE:UTILITY_BILL",
        }
    )
</script>
