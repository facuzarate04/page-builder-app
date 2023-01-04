export default class Block {

    /* Type Blocks functions */
    
    static isHeaderBlock(type) {
        return type === 'HeaderBlock';
    };
    
    static isLinkBlock(type) {
        return type === 'LinkBlock';
    };
    
    static isSocialBlock(type) {
        return type === 'SocialBlock';
    }

    /* Has Blocks functions */

    static hasSocialBlock(blocks) {
        if(blocks.length > 0)
            return blocks.filter(block => this.isSocialBlock(block.type)).length > 0;
    }

    static hasLinkBlock(blocks) {
        if(blocks.length > 0) 
            return blocks.filter(block => this.isLinkBlock(block.type)).length > 0;
    }

    static hasHeaderBlock(blocks) {
        if(blocks.length > 0)
            return blocks.filter(block => this.isHeaderBlock(block.type)).length > 0;
    }
}