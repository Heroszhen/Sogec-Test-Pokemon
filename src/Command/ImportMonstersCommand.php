<?php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Entity\Monster;
use Symfony\Component\Console\Input\InputArgument;
use Doctrine\ORM\EntityManagerInterface;

class ImportMonstersCommand extends Command{
    protected static $defaultName = 'app:import:csv';
    private $em;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('filepath', InputArgument::REQUIRED, 'le chemin du fichier')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filepath = $input->getArgument('filepath');

        //check the path of file
        if(!file_exists($filepath)){
            $output->writeln("Le fichier n'existe pas : {$filepath}");
            goto end;
        }

        //check the extension of the file
        if(strtolower(pathinfo($filepath, PATHINFO_EXTENSION)) != "csv"){
            $output->writeln("Veuillez importer un fichier csv, svp");
            goto end;
        }

        //open the file
        if (($handle = fopen($filepath, "r")) !== FALSE) {
            $row = 0;
            $titles = [];
            //store data of one line in an array
            while (($tab = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $mt = new Monster();
                //read this array
                foreach($tab as $key=>$value){
                    if($row == 0){
                        $output->writeln($value);
                        array_push($titles, $value);
                    }else{
                        if($row > 0){
                            $this->setMonster($titles, $mt, $key, $value);
                        }
                    }
                }
                if($row > 0){
                    $this->em->persist($mt);
                    $this->em->flush();
                    $output->writeln("{$mt->getName()} est enregistré");
                }
                $row++;
            }
            fclose($handle);
        }
        
        end:
        return 0;
    }

    //À noter que l'ordre des colonnes ne doit pas impacter l'import
    private function setMonster(array $titles, Monster $mt, int $index, string $value){
        switch (strtolower($titles[$index])) {
            case '#':
                $mt->setNumber((int)$value);
                break;
            case 'name':
                $mt->setName($value);
                break;
            case 'type 1':
                $mt->setType1($value);
                break;
            case 'type 2':
                $mt->setType2($value);
                break;
            case 'total':
                $mt->setTotal((int)$value);
                break;
            case 'hp':
                $mt->setHp((int)$value);
                break;
            case 'attack':
                $mt->setAttack((int)$value);
                break;
            case 'defense':
                $mt->setDefense((int)$value);
                break;
            case 'sp. atk':
                $mt->setSpatk((int)$value);
                break;
            case 'sp. def':
                $mt->setSpdef((int)$value);
                break;
            case 'speed':
                $mt->setSpeed((int)$value);
                break;
            case 'generation':
                $mt->setGeneration((int)$value);
                break;
            case 'legendary':
                if($value == "True")$mt->setIslegendary(true);
                break;
            default:
                break;
        }
    }
}