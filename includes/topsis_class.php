<?php
class TOPSIS
{
    public $data;
    public $atribut;
    public $bobot;

    public $normal;
    public $terbobot;
    public $solusi_ideal;
    public $jarak_solusi;
    public $preferensi;

    function __construct($data, $atribut, $bobot)
    {
        $this->data = $data;
        $this->atribut = $atribut;
        $this->bobot = $bobot;
        $this->get_nomalize();
        $this->get_normal_terbobot();
        $this->get_solusi_ideal();
        $this->get_jarak_solusi();
        $this->get_preferensi();
    }

    function get_nomalize()
    {
        $this->normal = array();
        $kuadrat = array();
        foreach ($this->data as $key => $val) {
            foreach ($val as $k => $v) {
                $kuadrat[$k] += ($v * $v);
            }
        }
        foreach ($this->data as $key => $val) {
            foreach ($val as $k => $v) {
                $this->normal[$key][$k] = $v / sqrt($kuadrat[$k]);
            }
        }
    }

    function get_normal_terbobot()
    {
        $this->terbobot = array();
        foreach ($this->normal as $key => $val) {
            foreach ($val as $k => $v) {
                $this->terbobot[$key][$k] = $v * $this->bobot[$k];
            }
        }
    }

    function get_solusi_ideal()
    {
        $this->solusi_ideal = array();
        $temp = array();

        foreach ($this->terbobot as $key => $val) {
            foreach ($val as $k => $v) {
                $temp[$k][] = $v;
            }
        }
        foreach ($temp as $key => $val) {
            $max = max($val);
            $min = min($val);
            if ($this->atribut[$key] == 'benefit') {
                $this->solusi_ideal['positif'][$key] = $max;
                $this->solusi_ideal['negatif'][$key] = $min;
            } else {
                $this->solusi_ideal['positif'][$key] = $min;
                $this->solusi_ideal['negatif'][$key] = $max;
            }
        }
    }

    function get_jarak_solusi()
    {
        $this->jarak_solusi = array();
        foreach ($this->terbobot as $key => $val) {
            foreach ($val as $k => $v) {
                $this->jarak_solusi[$key]['positif'] += ($v - $this->solusi_ideal['positif'][$k]) * ($v - $this->solusi_ideal['positif'][$k]);
                $this->jarak_solusi[$key]['negatif'] += ($v - $this->solusi_ideal['negatif'][$k]) * ($v - $this->solusi_ideal['negatif'][$k]);
            }
            $this->jarak_solusi[$key]['positif'] = sqrt($this->jarak_solusi[$key]['positif']);
            $this->jarak_solusi[$key]['negatif'] = sqrt($this->jarak_solusi[$key]['negatif']);
        }
    }

    function get_preferensi()
    {
        $this->preferensi = array();

        foreach ($this->jarak_solusi as $key => $val) {
            if (($val['positif'] + $val['negatif']) == 0)
                $this->preferensi[$key] = 0;
            else
                $this->preferensi[$key] = $val['negatif'] / ($val['positif'] + $val['negatif']);
        }
    }
}
