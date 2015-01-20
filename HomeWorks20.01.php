<?php

//Завдання 1
//Вибирається випадкове ціле додатнє число (1, 2, ...)
//Якщо це число має 2 цифри, слід вивести їх суму у двоцифровому форматі
//(наприклад 1 вивести як 01, 5 як 05, 17 як 17).
//Якщо це число має 3 або 4 цифри вивести це число у шіснадцятковій системі
//числення (наприклад 255 – FF).
//Якщо це число має 4 цифри вивести суму його перших двох цифр та останніх двох
//цифр у двоцифровому форматі.
//В усіх інших випадках просто вивести це число.

$a = mt_rand(1, 10000);
$c = (string) $a;
echo $a . '- Number </br>';
$b = strlen($a);
echo $b . '- String length</br>';
echo 'Result: ';
switch ($b) {
    case $b == 1:
        echo '0' . $a;
        break;
    case $b == 2:
        echo $a;
        break;
    case $b == 3:
        $v = dechex(bindec($a));
        echo 'це число у шіснадцятковій системі:' . $v . ' =)';
        break;
    case $b == 4:
        $v = dechex(bindec($a));
        echo 'це число у шіснадцятковій системі:' . $v . ' и сумма крайних чисел =';

    case $b == 4:
        echo $c{0} + $c{1};
        echo $c{2} + $c{3};
        break;
    default:
        echo $a;
        break;
}
echo '</br>-------------------------------Task2---------------------------------</br>';

//Завдання 2
//Гравець кидає 4 шестигранні кубики. Успіхом вважається випадок, коли на кубику
//випало 5 або 6. Вивести які шанси гравця отримати лише 1 успіх, лише 2 успіху, лише
//3 успіху та лише 4 успіху.
//Приклади: на кубиках випало 3, 5, 2, 1 – це 1 успіх. На кубиках випало 2, 5, 6, 6 – це 3
//успіху .

$kub = array(mt_rand(1, 6), mt_rand(1, 6), mt_rand(1, 6), mt_rand(1, 6));
$countKub = count($kub);
$kolUspex = 0;

for ($i = 0; $i < $countKub; $i++) {
    echo 'Кубик' . ($i + 1) . ': ' . $kub[$i] . '</br>';
    if ($kub[$i] == 5 or $kub[$i] == 6) {
        $kolUspex++;
    }
}

function veroyatnost($kolUspex) {
    $shansUspexa = 1 / 3; //вероятность 5 и 6
    $shansNeUspexa = 2 / 3; // вероятность выпадения 1, 2, 3, 4.
    $kolNeUspex = 4 - $kolUspex;
    return pow($shansUspexa, $kolUspex) * pow($shansNeUspexa, $kolNeUspex);
}

echo 'Количество успехов :' . $kolUspex . '</br>';
echo 'Вероятность успеха :';
switch ($kolUspex) {
    case $kolUspex == 0;
        echo veroyatnost($kolUspex);
        break;
    case $kolUspex == 1;
        echo veroyatnost($kolUspex);
        break;
    case $kolUspex == 2;
        echo veroyatnost($kolUspex);
        break;
    case $kolUspex == 3;
        echo veroyatnost($kolUspex);
        break;
    case $kolUspex == 4;
        echo veroyatnost($kolUspex);
        break;
    default:
        echo 'Ошибка!';
        break;
}
echo '</br>-------------------------------Task3.1---------------------------------</br>';

//Завдання 3
//Частина 1
//Деякий магазин має програму лоялності для клієнтів. Для ідентифікації клієнта
//використовується унікальний код, який має вигляд: XXYYYY. Де:
//• X – велика літера від A до F;
//• Y – цифра від 0 до 9.
//Інформація про клієнта зберігається у файлах, ім’я яких співпадає з відповідним
//кодом клієнта. Всі ці файли розташовані у директорії codes.
//Слід написати скрипт, який дозволить сгенерувати такий унікальний код для нового
//клієнта, а також створить відповідний файл у директорії codes.
//Код генерується випадково.

function createRandomFile() {
    $bykva = array('A', 'B', 'C', 'D', 'E', 'F');
    $chislo = mt_rand(0, 9);
    $bykva1 = mt_rand(0, 5);
    $bykva2 = mt_rand(0, 5);
    $result = array($bykva[$bykva1],
        $bykva[$bykva2], $chislo = mt_rand(0, 9),
        $chislo = mt_rand(0, 9),
        $chislo = mt_rand(0, 9),
        $chislo = mt_rand(0, 9),
        $chislo = mt_rand(0, 9));
    $result = implode('', $result);
    if (file_exists("code/$result.txt")) {
        createRandomFile();
    } else {
        $fp = fopen("code/$result.txt", "w");
        fwrite($fp, $result);
        fclose($fp);
    }
}

createRandomFile();
echo '</br>-------------------------------Task3.2---------------------------------</br>';

//Частина 2
//Модифікувати скрипт з частини 1 таким чином, щоб коди йшли по порядку. Тобто
//перший код AA0000, потім AA0001, ..., AA9999, AB0000, ..., AF9999, BA0000, ...

$r = array('A', 'A', 0, 0, 0, 0, 0);

function createFileByName() {
    global $r;
    $count = count($r) - 1;
    $r[$count] ++;
    for ($i = count($r) - 1; $i > 1; $i--) {
        if ($r[$i] > 9) {
            $r[$i] = 0;
            $r[$i - 1] ++;
            if ($r[$i - 1] == 'G') {
                $r[$i - 1] = 'A';
                $r[$i - 2] ++;
                if ($r[$i - 2] = 'G') {
                    $r[$i - 1] = 'F';
                    $r[$i - 2] = 'F';
                    exit();
                }
            }
        }
    }
    $a1 = implode('', $r);
    if (file_exists("code/$a1.txt")) {
        createFileByName();
    } else {
        $fp = fopen("code/$a1.txt", "w");
        fwrite($fp, $a1);
        fclose($fp);
    }
}

createFileByName();
?>
