<?php namespace Model;
/*doctrine orm mantığı model class isminin çoğulu tablo ismi buna Entity deniyor.
    Kolon isimlendirmene göre de değişkenleri oluşturuyorsun. */

//App\Model
//use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @Table(name="messages")
 **/
class Message
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="string") **/
    protected $text;

    public function getId()
    {
        return $this->id;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }
}
