<?php

session_start();

$button = filter_input(INPUT_POST, 'button');
$clear = filter_input(INPUT_POST, 'clear');
$all_clear = filter_input(INPUT_POST, 'all_clear');
$total = null;
$count = null;
$new_list = null;

if (isset($button)) {
    $_SESSION['list'][] = (int)$button;
} else {
    $_SESSION['list'] = [];
}

if (isset($all_clear)) {
    $_SESSION['list'] = [];
    session_destroy();
}

$total = array_sum($_SESSION['list']);

// 値を昇順に並び替え
sort($_SESSION['list']);

$count = array_count_values($_SESSION['list']);

// 重複した値を削除
$new_list = array_unique($_SESSION['list']);


?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Automatic Calculation App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="sanitize.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="icon">
            <div class="total">
                <i class="fa-solid fa-cash-register"></i>
            </div>
            <div class="order">
                <i class="fa-regular fa-file-lines"></i>
            </div>
            <div class="price">
                <i class="fa-solid fa-barcode"></i>
            </div>
        </div>
    </header>

    <main>
        <div class="wrap">
            <div class="total-price">
                <h3>合  計</h3>
                <dl>
                    <dt>数 量</dt>
                    <dd><?php echo count($_SESSION['list'])." "."点"?></dd>
                    <dt class="text">合計金額</dt>
                    <?php if (isset($total)) :?>
                    <dd class="total"><?php echo "¥"." ". number_format($total); ?></dd>
                    <?php endif; ?>
                </dl>
            </div>

            <div class="order-list">
                <h3>注文リスト</h3>
                <div class="list">
                    <div class="price">
                    <?php if (isset($_SESSION['list'])) :?>
                        <?php foreach ($new_list as $value): ?>
                        <p><?php echo "¥"." ". $value; ?></p>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </div>
                    <div class="quantity">
                    <?php if (isset($count)) :?>
                        <?php foreach ($count as $value): ?>
                        <p><?php echo $value." "."点"; ?></p>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                </div>
            </div>
            
            <div class="price-list">
                <h3>金  額</h3>
                <form action="" method="post">
                    <div class="inner">
                        <div class="three-hp">
                            <button type="submit" name="button" value="300">300</button>
                            <button type="submit" name="button" value="350">350</button>
                        </div>
                        <div class="four-hp">
                            <button type="submit" name="button" value="400">400</button>
                            <button type="submit" name="button" value="420">420</button>
                            <button type="submit" name="button" value="450">450</button>
                        </div>
                        <div class="five-hp">
                            <button type="submit" name="button" value="500">500</button>
                            <button type="submit" name="button" value="550">550</button>
                        </div>
                        <div class="six-hp">
                            <button type="submit" name="button" value="600">600</button>
                            <button type="submit" name="button" value="680">680</button>
                        </div>
                        <div class="seven-hp">
                            <button type="submit" name="button" value="780">780</button>
                        </div>
                        <div class="eight-hp">
                            <button type="submit" name="button" value="880">880</button>
                        </div>
                    </div>
                    <div class="clear">
                        <button type="submit" name="all_clear">クリア</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>