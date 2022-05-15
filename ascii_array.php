<?php

class AsciiArrayImplementation {
    public $ascii;
    public $discardedAscii;

    public function __construct () {
        $this->ascii = $this->generateAsciiCharacter();
        $this->discardedAscii = $this->discardArbitraryAsciiElements();
    }

    protected function generateAsciiCharacter() {
        $ascii = [];
        // generate ascii character from comma (,) to pipe (|)
        for ($i = 44; $i < 125; $i++) {
            $ascii[] = mb_convert_encoding(chr($i), 'UTF-8', 'ISO-8859-1');
        }
        return $ascii;
    }

    // discards 10 random ascii character from array
    protected function discardArbitraryAsciiElements () : array
    {
        $newAscii = $this->ascii;
        // shuffle the new ascii array
        // shuffle($newAscii);
        $n = 0;
        while ($n <= 10) {
            unset($newAscii[array_rand($newAscii)]);
            $n++;
        }
        return $newAscii;
    }

    // option 1 to find the missing asscii characters
    // determine the missing ascii characters discarded
    public function determineMissingAsciiCharacter() : array 
    {
        $originalAscii = $this->ascii;
        $newAscii = $this->discardedAscii;
        $missingAscii = array_diff($originalAscii, $newAscii);
        return [
            'originalAscii' => $originalAscii,
            'newAscii' => $newAscii,
            'missingAscii' => $missingAscii
        ];
    }

    // option 2 to find the missing asscii characters
    public function determineMissingAsciiCharacter2() : array 
    {
        $originalAscii = $this->ascii;
        $newAscii = $this->discardedAscii;
        $missingAscii = [];
        foreach ($originalAscii as $key => $value) {
            if (!in_array($value, $newAscii)) {
                $missingAscii[] = $value;
            }
        }
        return [
            'originalAscii' => $originalAscii,
            'newAscii' => $newAscii,
            'missingAscii' => $missingAscii
        ];
    }
}

if (isset($_GET['value'])) {
    $value = $_GET['value'];
    echo $value;
}

$response = new AsciiArrayImplementation();
echo json_encode($response->determineMissingAsciiCharacter());
// echo json_encode($response->determineMissingAsciiCharacter2());
