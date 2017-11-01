<?php
/**
 * Created by PhpStorm.
 * User: bag
 * Date: 24.07.17
 * Time: 12:23
 */

namespace App\MyLibrary\Laravel;
use Illuminate\Database\Schema\Grammars\MySqlGrammar as MySqlGrammarOrig;


/**
 * @todo remove after global fix
 * @note temporary fix of MySQL column case (column_name => COLUMN_NAME)
 * Class CustomMySqlGrammar
 * @package App\MyLibrary\Laravel
 */
class CustomMySqlGrammar extends MySqlGrammarOrig
{
    /**
     * Compile the query to determine the list of columns.
     *
     * @return string
     */
    public function compileColumnListing()
    {
        return 'select column_name as column_name from information_schema.columns where table_schema = ? and table_name = ?';
    }
}