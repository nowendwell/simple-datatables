<?php

trait CanDatatable
{
    public function scopeParseDatatables($query, $request)
    {
        $offset = $request->start;
        $limit = $request->length;
        // $order_by = $request->order[0]['column'] ?: 'created_at';
        // $order_dir = $request->order[0]['dir'] ?: 'desc';

        return $query
        ->select(DB::raw('SQL_CALC_FOUND_ROWS *'))
        ->skip($offset)
        ->take($limit)
        // ->orderBy($order_by, $order_dir)
        ;
    }

    public function getRecordsTotalAttribute()
    {
        return DB::select(DB::raw('SELECT FOUND_ROWS() as count'))[0]->count;
    }
}
