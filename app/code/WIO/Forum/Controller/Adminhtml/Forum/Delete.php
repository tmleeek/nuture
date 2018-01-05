<?php

/**
 * webideaonline.com.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://webideaonline.com/licensing/
 *
 */

namespace WIO\Forum\Controller\Adminhtml\Forum;

class Delete extends \Magento\Backend\App\Action {
  
  /**
   * {@inheritdoc}
   */
  protected function _isAllowed() {
    return $this->_authorization->isAllowed('WIO_Forum:forum_delete');
  }

  public function execute() {

    /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
    $resultRedirect = $this->resultRedirectFactory->create();
    $id = $this->getRequest()->getParam('topic_id');

    $model = $this->_objectManager->create('WIO\Forum\Model\Forum');
    $model->load($id);
    if ($model->getId()) {
      $model->setIsDeleted(1);
      try {
        $topicsDeleted = $this->deleteAllTopics($model->getId());
        $postsDeleted = $this->deleteAllPosts($model->getId());
        $model->save();
        $this->messageManager->addSuccess(__('You successfully delete forum'));
        $this->messageManager->addSuccess(__('Total %1 topic(s) deleted', $topicsDeleted));
        $this->messageManager->addSuccess(__('Total %1 post(s) deleted', $postsDeleted));
      } catch (Exception $ex) {
        $this->messageManager->addException($ex, __('Something went wrong while deleteing the forum.'));
      }
    }
    return $resultRedirect->setPath('*/*/');
  }

  protected function deleteAllTopics($parent_id){
    $modelFactory = $this->_objectManager->get('WIO\Forum\Model\TopicFactory');
    $collection = $modelFactory->create()->getCollection();
    $collection->getSelect()->where('parent_id=? AND is_deleted=0', $parent_id);
    $count = 0;
    foreach($collection as $itemDel){
      $modelFactory->create()->setId($itemDel->getId())
              ->delete();
      $count++;
    }
    return $count;
  }
  
  protected function deleteAllPosts($forum_id) {
    $modelFactory = $this->_objectManager->get('WIO\Forum\Model\PostFactory');
    $collection = $modelFactory->create()->getCollection();
    $collection->getSelect()->where('forum_id=? AND is_deleted=0', $forum_id);
    $count = 0;
    foreach($collection as $itemDel){
      $modelFactory->create()->setId($itemDel->getId())
              ->delete();
      $count++;
    }
    return $count;
  }
}
