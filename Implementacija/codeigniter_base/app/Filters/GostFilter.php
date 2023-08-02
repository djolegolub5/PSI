<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\KorisnikModel;
use App\Controllers\BaseController;

class GostFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = \Config\Services::session();
        if($session->has('idKor')){
            $korisnikModel = new KorisnikModel();
            $korisnik = $korisnikModel->find($session->get('idKor'));
            if($korisnik != null){
                $status = $korisnik->Status;
                if($status == 'Registrovan')return redirect()->to(site_url("Registrovan/pocetna"));
                else if($status == 'Kriticar')return redirect()->to(site_url("Kriticar/pocetna"));
                else if($status == 'Admin')return redirect()->to(site_url("Admin/pocetna"));
            }
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
