<?php
namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Models\Project;
use DataTables;
use Illuminate\Http\JsonResponse;
use Session;

class SessionCartService
{

    public function __construct (
        protected readonly ProductRepository $ProductRepository,
        protected readonly Product $product
        ) {}

    public function getProductList(): array
    {
        $data = [];
        $productData = $this->product->get();
        $sessionData = Session::get('Cart') ?: [];
        $data['productList'] = $productData;
        $data['cartData'] = $sessionData;

        return $data;
    }

    /**
     * Project update
     *
     * @param array $data
     * @param Project $project
     * @return void
     */
    public function update(array $data, Project $project)
    {
        return $this->ProductRepository->update($data, $project);
    }

    /**
     * Project update
     *
     * @param array $data
     * @param Project $project
     * @return void
     */
    public function delete(Project $project)
    {
        return $this->ProductRepository->delete($project);
    }    
    
    /**
    * Project create
    *
    * @param array $data
    * @return void
    */
    public function getProjectDetails() : JsonResponse
    {
        $data = Project::with(['user', 'client'])->get();
        
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('user', function ($row) {
                return $row->user->name ?? 'N/A';
            })
            ->addColumn('client', function ($row) {
                return $row->client->client_name ?? 'N/A';
            })
            ->addColumn('deadline', function ($row) {
                return date('d-m-Y', strtotime($row->deadline_at)) ?? 'N/A';
            })
            ->addColumn('action', function ($row) {
                $editUrl = route('projects.edit', $row->id);
                $deleteUrl = '';
                $btn = '<td><p data-placement="top" data-toggle="tooltip" title="Edit"><a class="btn btn-primary btn-xs" href="' . $editUrl . '" ><span class="glyphicon glyphicon-pencil"></span></a></p></td>
                        <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs"  href="' . $deleteUrl . '" ><span class="glyphicon glyphicon-trash"></span></button></p></td>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}