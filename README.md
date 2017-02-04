# magic-function-for-CI
Magic functions for codeigniter like CakePHP.

Clone the [`Magic.php`](https://github.com/jitu-git/magic-function-for-CI)  in your local directory and place it into `application/library` in your CI project.
Now set this library in `application/config/autoload.php` . so don't need to load in every controller.

    $autoload['library'] = array('Magic');
Now your magic library is ready to use with `$this->magic` instance.

#Structure: 
`$this->magic` Instance of library.
`->tableName` set table name for fetch data from DB.
`->findAll($conditions=array())` Get all data from table.
    
   Now the magic begin.

       $this->magic->tableName->findByTableColoumName($param);

#Example

    $this->magic->tableName->findById(2);
    $this->magic->tableName->findByName('user');
    $this->magic->tableName->findByUserName('user');
    $this->magic->tableName->findByEmail('user@email.com');
    
#Find All Results
    $this->magic->tableName->findAll($conditions = array());
#Count All Records
    $this->magic->tableName->findCount($conditions = array());
    
For more please read this [article](https://www.maxmarks.in/codes/magic-function-library-codeigniter-like-cakephp/)
   
