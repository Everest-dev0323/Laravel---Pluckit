<?php

namespace App\Exports;

use App\Newsletter;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;

class NewslettersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
		$get = $_GET;
		if(!empty($get['search'])){
		 $getObjNewsletter = Newsletter::where([[DB::raw("CONCAT(email_id)"), 'LIKE', "%{$get['search']}%"]])->orderBy('id','desc')->get();
		}else{
          $getObjNewsletter = Newsletter::orderBy('id','desc')->get();
		}
		if(!empty($getObjNewsletter[0])){
			$i=1;
			foreach($getObjNewsletter as $item){
				$arrNewsletter[] = array($i++,$item->email_id);
			}
		}
		return collect($arrNewsletter);
    }
	 public function headings(): array
    {
        return [
            'S.No',
            'Email Id',
            ];
    }
}
