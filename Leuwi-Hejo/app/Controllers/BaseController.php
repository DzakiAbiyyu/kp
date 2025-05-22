<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use Myth\Auth\Models\UserModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = ['user_permission'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    protected $media;
    protected $db;


    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.


        // Di BaseController.php
        if (logged_in()) {
            $userModel = new UserModel();
            $userModel->update(user_id(), [
                'last_active' => date('Y-m-d H:i:s')
            ]);
        }



        // Load model
        $mediaModel = new \App\Models\MediaSosialModel();

        // Ambil data media
        $this->media = $mediaModel->findAll();

        // E.g.: $this->session = service('session');
        \Config\Services::renderer()->setVar('media', $this->media);


        helper('auth'); // Tambahkan ini
    }

    protected function createNotification(string $title, string $message, string $type = 'info', string $icon = 'fas fa-info-circle', string $link = null, array $targetUserIds = null)
    {
        $actorId = user()->id;

        $this->db->table('notifications')->insert([
            'title'      => $title,
            'message'    => $message,
            'icon'       => $icon,
            'type'       => $type,
            'link'       => $link,
            'actor_id'   => $actorId,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $notifId = $this->db->insertID();

        $targets = $targetUserIds ?? $this->db->table('users')->select('id')->get()->getResultArray();
        foreach ($targets as $t) {
            $uid = is_array($t) ? $t['id'] : $t;
            $this->db->table('user_notifications')->insert([
                'user_id'         => $uid,
                'notification_id' => $notifId,
                'is_read'         => 0,
                'created_at'      => date('Y-m-d H:i:s')
            ]);
        }
    }
}
