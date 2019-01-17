<?php
   /**
   * geocode 1.0
   *
   * Uses Emad Fanous Geocoding Tool (http://emad.fano.us/blog/)
   * in order to obtain worldwide geographical coordinates (lat, long) or
   * geocode Virtual Earth or Google Maps
   *
   * Copyright (C) 2006 Luca Boni <luca.boni@fastwebnet.it>
   *
   * This program is free software; you can redistribute it and/or modify
   * it under the terms of the GNU General Public License as published by
   * the Free Software Foundation; either version 2 of the License, or
   * (at your option) any later version.
   *
   * This program is distributed in the hope that it will be useful,
   * but WITHOUT ANY WARRANTY; without even the implied warranty of
   * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   * GNU General Public License for more details.
   *
   * You should have received a copy of the GNU General Public License
   * along with this program; if not, write to the Free Software
   * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA
   *
   * @class        geocode
   * @version      V1.0 12 Feb 2006
   * @author       Luca Boni <luca.boni@fastwebnet.it>
   * @copyright    2006 Luca Boni
   */

   class geocode {

      /**
      * constructor
      */
      function geocode( $loc="", $address="", $city="", $country="", $state="", $zip="" ) {
         $this->fields['loc']     = $loc;
         $this->fields['address'] = $address;
         $this->fields['city']    = $city;
         $this->fields['country'] = $country;
         $this->fields['state']   = $state;
         $this->fields['zip']     = $zip;
      }

      /**
      * @function     locate
      * @returns      array
      * @description  Returns an array containing the search results.
      */
      function locate() {
         foreach( $this->fields as $key => $value ) {
            if( $value != "" )
               $fields[] = "$key=" . $this->fields["$key"];
         }
         $fields[] = "format=xml";
         $q = str_replace( " ", "+", implode( "&", $fields ) );
         if( $gm = @fopen( "http://www.localsearchmaps.com/geo/?$q", "r") ) {
            $tmp = @fread( $gm, 30000 );
            @fclose( $gm );
            $lat_value = $this->untag( $tmp, "latitude" );
            $lng_value = $this->untag( $tmp, "longitude" );
            $city      = $this->untag( $tmp, "city" );
            $state     = $this->untag( $tmp, "state" );
            $country   = $this->untag( $tmp, "country" );
            $match     = $this->untag( $tmp, "matchlevel" );
            $error     = $this->untag( $tmp, "error" );
         } else {
            $error = "NO_CONNECTION" ;
         }
         //
         return( array( "query" => $q, "latitude" => $lat_value, "longitude" => $lng_value, "city" => $city, "state" => $state, "country" => $country, "matchLevel" => $match, "error" => $error ) );
      }

      /**
      * @function     api
      * @returns      string
      * @param        $level:string Zoom level
      * @param        $type:string API's type (gm=Google Map API|ve=Virtual Earth API)
      * @description  Returns a string containing a js function according to the API's type.
      */
      function api( $level="", $type="gm" ) {
         if( $type == "ve" )
            $this->fields['ve'] = 1;
         if( $level )
            $this->fields['level'] = $level;
         //
         foreach( $this->fields as $key => $value ) {
            if( $value != "" )
               $fields[] = "$key=" . $this->fields["$key"];
         }
         $q = str_replace( " ", "+", implode( "&", $fields ) );
         if( $gm = @fopen( "http://www.localsearchmaps.com/geo/?$q", "r") ) {
            $tmp = @fread( $gm, 30000 );
            @fclose( $gm );
         } else {
            $tmp = "alert('No data retrieved');" ;
         }
         //
         return $tmp;
      }


      /*
      * @function     untag
      * @returns      mixed
      * @param        $string:string The string to analyze
      * @param        $string:string The tag to filter
      * @param        $mode:int 0=returns a string|1=returns an array
      * @author       Chris Heilmann
      * @description  Filters the content of $tag from $string
      */
      function untag( $string, $tag, $mode=0 ) {
         $tmpval = "";
         $preg = "/<" . $tag . ">(.*?)<\/" . $tag . ">/si";
         preg_match_all( $preg, $string, $tags );
         foreach( $tags[1] as $tmpcont ) {
            if( $mode == 1 ) {
               $tmpval[] = $tmpcont;
            } else {
               $tmpval .= $tmpcont;
            }
         }
         return $tmpval;
      }
   }
?>