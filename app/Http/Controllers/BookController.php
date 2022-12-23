<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\BookResource;
use Brian2694\Toastr\Facades\Toastr;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books =  Book::manipulateViewData();
        return view('books.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        Validator::make($input, [
            'title'  => ['required', 'max:10'],
            'author' => ['required', 'string'],
            'status' => ['required', 'string']
        ])->validate();
        $resMessage = [];
        try {
            $response = Book::create([
                'title' =>  $input['title'],
                'author' => $input['author'],
                'status' => $input['status'],
                'check_out_by' => auth()->user()->id
            ]);
            $resMessage = ['status' => 'success' , 'message' => 'Record created successfully.'];
        } catch (QueryException $e) {
            $resMessage = ['status' => 'error' , 'message' => 'Record not created successfully.', 'error_details' => $e->getMessage()];
        } catch (\Exception $e) {
            $resMessage = ['status' => 'error' , 'message' => 'Record not created successfully.', 'error_details' => $e->getMessage()];
        }
    	return redirect()->route('books.index')->with('response', $resMessage['message']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $book = new BookResource($book);
        return view('books.show',compact('book'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $book = new BookResource($book);
        return view('books.edit',compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Book $book)
    {
        $input = $request->all();
    
        Validator::make($input, [
            'title'  => ['required', 'max:10'],
            'author' => ['required', 'string'],
            'status' => ['required', 'string']
        ])->validate();
        
        $updateArray = [];
        $updateArray['title'] = $input['title'];
        $updateArray['author'] = $input['author'];
        $updateArray['status'] = $input['status'];
        $updateArray['check_out_by'] = auth()->user()->id;
        $resMessage = [];
        try {
           $book->update($updateArray);
           $resMessage = ['status' => 'success' , 'message' => 'Record updated successfully.'];
        } catch (QueryException $e) {
            $resMessage = ['status' => 'error' , 'message' => 'Record not updated successfully.', 'error_details' => $e->getMessage()];
        } catch (\Exception $e) {
            $resMessage = ['status' => 'error' , 'message' => 'Record not updated successfully.', 'error_details' => $e->getMessage()];
        }  	
        
        //Toastr::info('Messages in here', 'Success');
        return redirect()->route('books.index')->with('response', $resMessage['message']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resMessage = [];
        try {
            $book = Book::find($id);
            $book->delete();
            $resMessage = ['status' => 'success' , 'message' => 'Record deleted successfully.'];
         } catch (QueryException $e) {
             $resMessage = ['status' => 'error' , 'message' => 'Record not deleted successfully.', 'error_details' => $e->getMessage()];
         } catch (\Exception $e) {
             $resMessage = ['status' => 'error' , 'message' => 'Record not deleted successfully.', 'error_details' => $e->getMessage()];
         }  	 
              
         return redirect()->route('books.index')->with('response', $resMessage['message']);
       
    }
}
