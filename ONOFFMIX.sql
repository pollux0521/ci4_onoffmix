CREATE TABLE users(
    _id int(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
    username varchar(32) NOT NULL UNIQUE,
    email varchar(32) NOT NULL UNIQUE,
    pw varchar(64) NOT NULL
);

CREATE TABLE requestMT(
    _rid int(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
    _mid int(11),
    _gid int(11),
    _id int(11),
    reason varchar(300) NOT NULL,
    Approval boolean default 0,
    FOREIGN KEY(_mid) REFERENCES MT(_mid) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE,
    FOREIGN KEY(_gid) REFERENCES MTGroup(_gid) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE,
    FOREIGN KEY(_id) REFERENCES MT(_id) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
);

CREATE TABLE MT(
    _mid int(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
    mtName varchar(64) NOT NULL UNIQUE,
    _id int(11),
    viewCount int(11) default 0,
    requestCount int(11) default 0,
    groupCount int(11),
    registTime DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(_id) REFERENCES users(_id)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

# MT 소개글 추가 데이터베이스 필요
CREATE TABLE MTGroup(
    _gid int(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
    _mid int(11),
    groupname varchar(64) NOT NULL,
    limitHead int(11) NOT NULL,
    accessHead int(11) default 0,
    startAccessTime DATETIME NOT NULL,
    endAccessTime DATETIME NOT NULL,
    startMTTime DATETIME NOT NULL,
    endMTTime DATETIME NOT NULL,
    approvalType boolean NOT NULL,
    mtName varchar(64),
    FOREIGN KEY(_mid) REFERENCES MT(_mid)
    ON DELETE CASCADE
    on UPDATE CASCADE,
    FOREIGN KEY(mtName) REFERENCES MT(mtName)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);
