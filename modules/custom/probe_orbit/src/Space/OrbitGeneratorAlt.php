<?php

/* 
 *  An alternative service creates a string 'ORRRRbit'
 *  Be sure to watch space/indents in .yml files
 */

namespace Drupal\probe_orbit\Space;


class OrbitGeneratorAlt 
{
  public function getOrbitalt($length) 
    {
      $string = 'O'.str_repeat('R', $length).'bit!';
      return $string;
    }
}

