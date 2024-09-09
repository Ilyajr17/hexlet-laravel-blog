<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ArticleController extends Controller
{
    public static function createNewSheet($spreadsheet, $sheetIndex)
    {
        $spreadsheet->createSheet($sheetIndex);
        $sheet = $spreadsheet->getSheet($sheetIndex);
        // заголовки
        $sheet->setCellValue('A1', 'ID');    // Заголовок для ID
        $sheet->setCellValue('B1', 'Title'); // Заголовок для Title
        return $sheet;

    }
    public function index(Request $request)
    {
        ini_set('max_execution_time', 300);
        ini_set('memory_limit', '-1');

        $data = [
            [
                'id' => 1,
                'title' => 'vanz',
            ],
            [
                'id' => 2,
                'title' => 'ole',
            ],
        ];

        $spreadsheet = new Spreadsheet();

        $maxRowsPerSheet = 500000; // Максимальное количество строк на листе
$currentRow = 2; // Номер текущей строки
$sheetIndex = 0; // Индекс текущего листа

//Получаем текущий активный лист
// $sheet = $spreadsheet->getActiveSheet();

$currentSheet = ArticleController::createNewSheet($spreadsheet, $sheetIndex);

// Генерация данных
$numberOfRows = 1120000; // Общее количество строк данных
for ($i = 1; $i <= $numberOfRows; $i++) {
    // Если текущая строка превышает лимит, создайте новый лист
    if ($currentRow > $maxRowsPerSheet) {
        $sheetIndex++;
        $currentSheet = ArticleController::createNewSheet($spreadsheet, $sheetIndex);
        $currentRow = 2; // Начать со второй строки на новом листе (первая - заголовки)
    }

    // Заполняем данные
    $id = $i; // ID будет равен номеру строки
    // echo "<pre>";
    // var_dump($sheetIndex);
    // echo "</pre>";
    $title = 'Title ' . rand(1, 10000); // Случайное название
    $currentSheet->setCellValue("A{$currentRow}", $id);
    $currentSheet->setCellValue("B{$currentRow}", $title);
    $currentRow++;
}

$writer = new Xlsx($spreadsheet);

$writer->save('hello.xlsx');
echo "Данные успешно записаны в large_data.xlsx.";
        // echo 'hi';
        // die;
        $name = $request->input('name');

        $articles = $name ? Article::where('name', 'LIKE', "%{$name}%")->paginate(5) : Article::paginate(5);

        return view('article.index', compact('articles', 'name'));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('article.show', compact('article'));
    }

    public function create()
    {
        // Передаем в шаблон вновь созданный объект. Он нужен для вывода формы
        $article = new Article();
        return view('article.create', compact('article'));
    }

      // Здесь нам понадобится объект запроса для извлечения данных
      public function store(Request $request)
      {
          // Проверка введенных данных
          // Если будут ошибки, то возникнет исключение
          // Иначе возвращаются данные формы


          $this->validate($request, [
              'name' => 'required|unique:articles',
              'body' => 'required|min:2',
          ]);

          $article = new Article();
          // Заполнение статьи данными из формы
          $article->fill($request->all());
          // При ошибках сохранения возникнет исключение
          $article->save();

          // Редирект на указанный маршрут
          return redirect()
              ->route('articles.index');
      }

    public function edit($id)
    {
        $article = Article::findOrFail($id);

        return view('article.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $this->validate($request, [
        // У обновления немного измененная валидация
        // В проверку уникальности добавляется название поля и id текущего объекта
        // Если этого не сделать, Laravel будет ругаться, что имя уже существует
        'name' => 'required|unique:articles,name,' . $article->id,
        'body' => 'required|min:2',
        ]);

        $article->fill($request->all());
        $article->save();

        return redirect()
            ->route('articles.index');
    }

    public function destroy($id)
    {
    // DELETE — идемпотентный метод, поэтому результат операции всегда один и тот же
        $article = Article::find($id);

        if ($article) {
            $article->delete();
        }

        return redirect()->route('articles.index');
    }

    public function report()
    {
echo "hi";
var_dump($_POST);
die;
    }
}
