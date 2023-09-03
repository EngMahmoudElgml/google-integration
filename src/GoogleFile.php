<?php


namespace EngMahmoudElgml\GoogleIntegration;


class GoogleFile extends GoogleConnection
{
    private $fileId;
    /**
     * @var \Google_Service_Drive_DriveFile
     */
    private $driveFile;
    /**
     * @var int
     */
    private $defaultFileName;

    public function __construct($fileId, $token = [])
    {
        parent::__construct($token);
        $this->fileId = $fileId ;
        $this->service  = new \Google_Service_Drive($this->client);
        $this->driveFile = new \Google_Service_Drive_DriveFile();
        $this->defaultFileName  = rand(50, 50000000) ;
    }

    public function copy($fileName = false, $folderId = false): \Google_Service_Drive_DriveFile
    {
        $this->driveFile->setName(($fileName) ? $fileName : $this->defaultFileName);

        if ($folderId)
        $this->driveFile->setParents([$folderId]);

        return  $this->service->files->copy($this->fileId , $this->driveFile);
    }

        /*
        * Supported Mime Types : https://developers.google.com/drive/api/guides/ref-export-formats
        * */

    public function export($mimeType  = 'application/pdf' , $path  = false , $fileName = false)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://www.googleapis.com/drive/v3/files/{$this->fileId}/export?mimeType={$mimeType}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization:Bearer '. $this->client->getAccessToken()['access_token'],
        ]);
        $response = curl_exec($ch);
        curl_close ($ch);

        if ($path &  $fileName)
        \Storage::disk('local')->put( $path .'/'. $fileName, $response);

        return  $response;
    }

    public function share($email,$role): void
    {
        $userPermission = new \Google_Service_Drive_Permission(array(
            'type' => 'user',
            'role' => $role,
            'emailAddress' => $email
        ));

        $this->service->permissions->create($this->fileId,$userPermission);

        $request = $this->service->permissions
            ->create($this->fileId, $userPermission,array('fields' => 'id'));

    }

    public function delete()
    {
        $this->service->files->delete($this->fileId);
    }

}
