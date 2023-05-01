<?php
if (isset($_COOKIE['gdpr_consent'])) {
    // Код за показване на страницата без кутията за съгласие на GDPR
} else {
    echo '
    <div class="bg-white shadow border text-center" style="position: fixed; padding: 50px 0; width: 100%; bottom: 0; left: 0; z-index:99999999">
        <form method="post">
                <div class="container mb-4">
                    <label>
                        <input type="hidden" name="gdpr_consent" value="1">
                        <span class="text-danger fs-3 text-uppercase">Можем ли да използваме бисквитки?</span>
                        <br>
                        Ние използваме бисквитки и подобни технологии, за да предоставим нашите услуги.
                    </label>
                </div>
                <div class="container">
                    <button class="btn btn-success rounded-pill px-5 py-3" type="submit">ПРИЕМИ</button>
                </div>
        </form>
    </div>
    ';
}
?>