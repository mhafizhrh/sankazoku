<?php
class Tes extends CI_Controller {

        public function reply($ticket_id)
        {
                if ($ticket_id == '11') {

                	
                	echo "ID tiket : " . $ticket_id;

                } else {
                	echo "TIket tidak ditemukan";
                	
                }
        }
}