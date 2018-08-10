<?php
/**
 * Created by PhpStorm.
 * User: miroslav
 * Date: 01.08.18
 * Time: 15:42
 */

use Minexsystems\SumSub\Assets\SumSubTelegramAssets;

SumSubTelegramAssets::register($this)
?>
<div id="telegram_passport_auth"></div>

<script>
    Telegram.Passport.createAuthButton('telegram_passport_auth', {
        bot_id:       <?= $botId; ?>,
        scope:        [ <?= $scope; ?>],
        public_key:   '-----BEGIN PUBLIC KEY-----\n' +
            'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAz4BVYGm1jd+ow5NWkIJM\n' +
            '3C1kvob5KBFHgqL+PQvATSrUkCDsod9cuL7gWOUez5l6yld7xkspXPcv5SwdJJ8v\n' +
            '1vPbdDazrEb+pMExbE1d1AFyEDLxOgeJ4O2FM2RsxEoVhaV9UnNKFMugru54EKmI\n' +
            'IUREG67UL+2dvk4HPWIh/tkjz++pQVO0fM/bw0Cx2qBIpofZiP/dvYADDG4UDIvu\n' +
            'OxWkwp5+2rzB4kkV1BaDANVu0A8N3dE4Mdu5NvFKlyz0Vp0BRgH9Gc8FphjAZHNV\n' +
            'wmJodKL+R9xAjmE/nTaTCxoan15Q2j4IZvGdBPhCq9eK+BNxhuJK0mgO+KCQvCJp\n' +
            'lwIDAQAB\n' +
            '-----END PUBLIC KEY-----',
        payload:      "<?= $accessToken; ?>", // <-- put here the token generated on your backend
        // callback_url: 'https://example.com/callback/' // place callback url here if needed
    }, {
        text: 'KYC Check via Telegram Passport' // custom text
    });
</script>
